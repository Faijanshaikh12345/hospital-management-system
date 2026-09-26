<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $billings = Billing::with(['patient.user', 'doctor.user'])
            ->latest()
            ->get();

        return view('billings.index', compact('billings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $patients = Patient::with('user')->get();
        $doctors  = Doctor::with('user')->get();

        $invoiceNumber = $this->generateInvoiceNumber();

        return view('billings.create', compact('patients', 'doctors', 'invoiceNumber'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id'        => 'required|exists:patients,id',
            'doctor_id'         => 'nullable|exists:doctors,id',
            'consultation_fee'  => 'required|numeric|min:0',
            'medicine_charges'  => 'required|numeric|min:0',
            'other_charges'     => 'required|numeric|min:0',
            'discount'          => 'required|numeric|min:0',
            'paid_amount'       => 'required|numeric|min:0',
            'billing_date'      => 'required|date',
            'payment_method'    => 'nullable|in:cash,card,upi,insurance,other',
            'status'            => 'required|in:pending,paid,partially_paid,cancelled',
            'notes'             => 'nullable|string',
        ]);

        // Auto-calculate total
        $validated['total_amount'] = $validated['consultation_fee']
            + $validated['medicine_charges']
            + $validated['other_charges']
            - $validated['discount'];

        // Auto-generate unique invoice number
        $validated['invoice_number'] = $this->generateInvoiceNumber();

        Billing::create($validated);

        return redirect()
            ->route('billings.index')
            ->with('success', 'Invoice created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Billing $billing)
    {
        $billing->load(['patient.user', 'doctor.user']);

        return view('billings.show', compact('billing'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Billing $billing)
    {
        $patients = Patient::with('user')->get();
        $doctors  = Doctor::with('user')->get();

        return view('billings.edit', compact('billing', 'patients', 'doctors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Billing $billing)
    {
        $validated = $request->validate([
            'patient_id'        => 'required|exists:patients,id',
            'doctor_id'         => 'nullable|exists:doctors,id',
            'consultation_fee'  => 'required|numeric|min:0',
            'medicine_charges'  => 'required|numeric|min:0',
            'other_charges'     => 'required|numeric|min:0',
            'discount'          => 'required|numeric|min:0',
            'paid_amount'       => 'required|numeric|min:0',
            'billing_date'      => 'required|date',
            'payment_method'    => 'nullable|in:cash,card,upi,insurance,other',
            'status'            => 'required|in:pending,paid,partially_paid,cancelled',
            'notes'             => 'nullable|string',
        ]);

        // Auto-calculate total (invoice_number stays unchanged)
        $validated['total_amount'] = $validated['consultation_fee']
            + $validated['medicine_charges']
            + $validated['other_charges']
            - $validated['discount'];

        $billing->update($validated);

        return redirect()
            ->route('billings.index')
            ->with('success', 'Invoice updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Billing $billing)
    {
        $billing->delete();

        return redirect()
            ->route('billings.index')
            ->with('success', 'Invoice deleted successfully.');
    }

    /**
     * Generate a unique sequential invoice number, e.g. INV-000001.
     */
    private function generateInvoiceNumber(): string
    {
        $lastId = Billing::max('id') ?? 0;

        return 'INV-' . str_pad($lastId + 1, 6, '0', STR_PAD_LEFT);
    }
}
