<?php

namespace App\Http\Controllers;

use App\Models\Admission;
use App\Models\Appointment;
use App\Models\Billing;
use App\Models\Doctor;
use App\Models\Medicine;
use App\Models\Patient;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    /**
     * Display the reports dashboard.
     */
    public function index(Request $request)
    {
        // ======= Summary Cards =======
        $totalPatients     = Patient::count();
        $totalDoctors      = Doctor::count();
        $totalAppointments = Appointment::count();

        $totalRevenue   = Billing::sum('paid_amount');
        $pendingRevenue = Billing::where('status', '!=', 'cancelled')
            ->get()
            ->sum(fn($b) => $b->total_amount - $b->paid_amount);

        $activeAdmissions = Admission::where('status', 'admitted')->count();
        $lowStockMedicines = Medicine::where('stock_quantity', '<=', 10)
            ->where('stock_quantity', '>', 0)
            ->count();
        $outOfStockMedicines = Medicine::where('stock_quantity', '<=', 0)->count();

        // ======= Filterable Billing Table =======
        $query = Billing::with(['patient.user', 'doctor.user']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('invoice_number', 'like', "%{$search}%")
                  ->orWhereHas('patient.user', function ($q2) use ($search) {
                      $q2->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('from_date')) {
            $query->whereDate('billing_date', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('billing_date', '<=', $request->to_date);
        }

        $billings = $query->latest()->get();

        return view('reports.index', compact(
            'totalPatients',
            'totalDoctors',
            'totalAppointments',
            'totalRevenue',
            'pendingRevenue',
            'activeAdmissions',
            'lowStockMedicines',
            'outOfStockMedicines',
            'billings'
        ));
    }

    /**
     * Export the filtered billing report to CSV (Excel-compatible).
     */
    public function export(Request $request): StreamedResponse
    {
        $query = Billing::with(['patient.user', 'doctor.user']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('invoice_number', 'like', "%{$search}%")
                  ->orWhereHas('patient.user', function ($q2) use ($search) {
                      $q2->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('from_date')) {
            $query->whereDate('billing_date', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('billing_date', '<=', $request->to_date);
        }

        $billings = $query->latest()->get();

        $filename = 'billing_report_' . now()->format('Y_m_d_His') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($billings) {
            $file = fopen('php://output', 'w');

            // Header row
            fputcsv($file, [
                'Invoice Number', 'Patient', 'Doctor', 'Billing Date',
                'Consultation Fee', 'Medicine Charges', 'Other Charges',
                'Discount', 'Total Amount', 'Paid Amount', 'Balance',
                'Payment Method', 'Status',
            ]);

            // Data rows
            foreach ($billings as $billing) {
                fputcsv($file, [
                    $billing->invoice_number,
                    $billing->patient->user->name ?? '—',
                    $billing->doctor->user->name ?? '—',
                    $billing->billing_date ? $billing->billing_date->format('d M Y') : '—',
                    number_format($billing->consultation_fee, 2),
                    number_format($billing->medicine_charges, 2),
                    number_format($billing->other_charges, 2),
                    number_format($billing->discount, 2),
                    number_format($billing->total_amount, 2),
                    number_format($billing->paid_amount, 2),
                    number_format($billing->total_amount - $billing->paid_amount, 2),
                    $billing->payment_method ? ucfirst($billing->payment_method) : '—',
                    str_replace('_', ' ', $billing->status),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
