<?php

namespace App\Http\Controllers;

// use App\Models\Department;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::with(['user', 'doctor.user', 'doctor.department'])->latest()->get();
        return view('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $doctors = Doctor::with(['user', 'department'])->get();
        return view('patients.create', compact('doctors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date_of_birth' => 'required|date|before:today',
            'gender' => 'required|in:male,female,other',
            'phone' => 'required|digits:10',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'doctor_id' => 'nullable|exists:doctors,id',
            'address' => 'nullable|string',
            'blood_group' => 'nullable|string|max:10',
            'emergency_contact' => 'nullable|digits:10',
            'emergency_contact_name' => 'nullable|string|max:255',
            'medical_history' => 'nullable|string',
            'allergies' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'role' => 'patient',
            'status' => $validated['status'],
        ]);

        $patientData = collect($validated)
            ->except(['name', 'email', 'phone', 'password', 'status'])
            ->toArray();

        $patientData['user_id'] = $user->id;

        Patient::create($patientData);

        return redirect()
            ->route('patients.index')
            ->with('success', 'Patient created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        $patient->load(['user', 'doctor.user', 'doctor.department']);
        return view('patients.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        $doctors = Doctor::with(['user', 'department'])->get();
        $patient->load('user');

        return view('patients.edit', compact('patient', 'doctors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'patient_id' => 'required|string|max:255|unique:patients,patient_id,' . $patient->id,
            'name' => 'required|string|max:255',
            'date_of_birth' => 'required|date|before:today',
            'gender' => 'required|in:male,female,other',
            'phone' => 'required|digits:10',
            'email' => 'required|email|max:255|unique:users,email,' . $patient->user_id,
            'doctor_id' => 'nullable|exists:doctors,id',
            'address' => 'nullable|string',
            'blood_group' => 'nullable|string|max:10',
            'emergency_contact' => 'nullable|digits:10',
            'emergency_contact_name' => 'nullable|string|max:255',
            'medical_history' => 'nullable|string',
            'allergies' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        // Update user account
        $patient->user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'status' => $validated['status'],
        ]);

        // Update patient, stripping fields that now live only on User
        $patientData = collect($validated)
            ->except(['name', 'email', 'phone', 'status'])
            ->toArray();

        $patient->update($patientData);

        return redirect()
            ->route('patients.index')
            ->with('success', 'Patient updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        $patient->user->delete();
        return redirect()
            ->route('patients.index')
            ->with('success', 'Patient Deleted successfully.');
    }
}
