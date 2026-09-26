<?php

namespace App\Http\Controllers;

use App\Models\Admission;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;

class AdmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admissions = Admission::with(['patient.user', 'doctor.user'])
            ->latest()
            ->get();

        return view('admissions.index', compact('admissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $patients = Patient::with('user')->get();
        $doctors  = Doctor::with('user')->get();

        return view('admissions.create', compact('patients', 'doctors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id'      => 'required|exists:patients,id',
            'doctor_id'       => 'nullable|exists:doctors,id',
            'ward'            => 'nullable|string|max:255',
            'bed_number'      => 'nullable|string|max:50',
            'admission_date'  => 'required|date',
            'discharge_date'  => 'nullable|date|after_or_equal:admission_date',
            'reason'          => 'nullable|string',
            'diagnosis'       => 'nullable|string',
            'total_charges'   => 'required|numeric|min:0',
            'status'          => 'required|in:admitted,discharged,transferred',
        ]);

        Admission::create($validated);

        return redirect()
            ->route('admissions.index')
            ->with('success', 'Admission record created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Admission $admission)
    {
        $admission->load(['patient.user', 'doctor.user']);

        return view('admissions.show', compact('admission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admission $admission)
    {
        $patients = Patient::with('user')->get();
        $doctors  = Doctor::with('user')->get();

        return view('admissions.edit', compact('admission', 'patients', 'doctors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admission $admission)
    {
        $validated = $request->validate([
            'patient_id'      => 'required|exists:patients,id',
            'doctor_id'       => 'nullable|exists:doctors,id',
            'ward'            => 'nullable|string|max:255',
            'bed_number'      => 'nullable|string|max:50',
            'admission_date'  => 'required|date',
            'discharge_date'  => 'nullable|date|after_or_equal:admission_date',
            'reason'          => 'nullable|string',
            'diagnosis'       => 'nullable|string',
            'total_charges'   => 'required|numeric|min:0',
            'status'          => 'required|in:admitted,discharged,transferred',
        ]);

        $admission->update($validated);

        return redirect()
            ->route('admissions.index')
            ->with('success', 'Admission record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admission $admission)
    {
        $admission->delete();

        return redirect()
            ->route('admissions.index')
            ->with('success', 'Admission record deleted successfully.');
    }
}
