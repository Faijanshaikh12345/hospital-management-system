<?php

namespace App\Http\Controllers;

use App\Models\Admission;
use App\Models\Appointment;
use App\Models\Billing;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\MedicalRecord;
use App\Models\Medicine;
use App\Models\Patient;
use App\Models\Prescription;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->role;

        $data = [];

        // ======= ADMIN: sees everything =======
        if ($role === 'admin') {
            $data['totalUsers']        = User::count();
            $data['totalDoctors']      = Doctor::count();
            $data['totalPatients']     = Patient::count();
            $data['totalDepartments']  = Department::count();
            $data['totalAppointments'] = Appointment::count();
            $data['totalRevenue']      = Billing::sum('paid_amount');
            $data['activeAdmissions']  = Admission::where('status', 'admitted')->count();
            $data['lowStockMedicines'] = Medicine::where('stock_quantity', '<=', 10)->count();
        }

        // ======= DOCTOR =======
        if ($role === 'doctor') {
            $data['totalDoctors']      = Doctor::count();
            $data['totalDepartments']  = Department::count();
            $data['totalPatients']     = Patient::count();
            $data['totalAppointments'] = Appointment::count();

            $doctor = Doctor::where('user_id', $user->id)->first();
            if ($doctor) {
                $data['myAppointments'] = Appointment::where('doctor_id', $doctor->id)->count();
                $data['myAdmissions']   = Admission::where('doctor_id', $doctor->id)
                    ->where('status', 'admitted')->count();
            }
        }

        // ======= RECEPTIONIST =======
        if ($role === 'receptionist') {
            $data['totalPatients']     = Patient::count();
            $data['totalDoctors']      = Doctor::count();
            $data['totalAppointments'] = Appointment::count();
            $data['totalRevenue']      = Billing::sum('paid_amount');
            $data['pendingBillings']   = Billing::where('status', 'pending')->count();
        }

        // ======= NURSE =======
        if ($role === 'nurse') {
            $data['totalPatients']     = Patient::count();
            $data['activeAdmissions']  = Admission::where('status', 'admitted')->count();
            $data['lowStockMedicines'] = Medicine::where('stock_quantity', '<=', 10)->count();
        }

        // ======= PATIENT =======
        if ($role === 'patient') {
            $patient = Patient::where('user_id', $user->id)->first();

            if ($patient) {
                $data['myAppointments']   = Appointment::where('patient_id', $patient->id)->count();
                $data['myMedicalRecords'] = MedicalRecord::where('patient_id', $patient->id)->count();
                $data['myPrescriptions']  = Prescription::where('patient_id', $patient->id)->count();
                $data['myBillingsDue']    = Billing::where('patient_id', $patient->id)
                    ->where('status', '!=', 'paid')
                    ->get()
                    ->sum(fn($b) => $b->total_amount - $b->paid_amount);
            }
        }

        return view('dashboard', $data);
    }
}
