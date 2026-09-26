<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\MedicalRecord;
use App\Models\Patient;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicalRecords = MedicalRecord::with(['patient.user', 'doctor.user'])
            ->latest()
            ->get();

        return view('medicalRecord.index', compact('medicalRecords'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $patients = Patient::with('user')->get();
        $doctors  = Doctor::with('user')->get();

        return view('medicalRecord.create', compact('patients', 'doctors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id'  => 'required|exists:patients,id',
            'doctor_id'   => 'nullable|exists:doctors,id',
            'record_type' => 'required|in:consultation,lab_report,x_ray,surgery,vaccination,other',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'record_date' => 'required|date',
            'attachment'  => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'status'      => 'required|in:active,archived',
        ]);

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Save directly into public/medicalimage
            $file->move(public_path('medicalimage'), $filename);

            $validated['attachment'] = $filename;
        }

        MedicalRecord::create($validated);

        return redirect()
            ->route('medicalRecord.index')
            ->with('success', 'Medical record created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MedicalRecord $medicalRecord)
    {
        $medicalRecord->load(['patient.user', 'doctor.user']);

        return view('medicalRecord.show', compact('medicalRecord'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MedicalRecord $medicalRecord)
    {
        $patients = Patient::with('user')->get();
        $doctors  = Doctor::with('user')->get();

        return view('medicalRecord.edit', compact('medicalRecord', 'patients', 'doctors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MedicalRecord $medicalRecord)
    {
        $validated = $request->validate([
            'patient_id'  => 'required|exists:patients,id',
            'doctor_id'   => 'nullable|exists:doctors,id',
            'record_type' => 'required|in:consultation,lab_report,x_ray,surgery,vaccination,other',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'record_date' => 'required|date',
            'attachment'  => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'status'      => 'required|in:active,archived',
        ]);

        if ($request->hasFile('attachment')) {
            // Delete old file if it exists
            if ($medicalRecord->attachment) {
                $oldPath = public_path('medicalimage/' . $medicalRecord->attachment);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $file = $request->file('attachment');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('medicalimage'), $filename);

            $validated['attachment'] = $filename;
        }

        $medicalRecord->update($validated);

        return redirect()
            ->route('medicalRecord.index')
            ->with('success', 'Medical record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicalRecord $medicalRecord)
    {
        // Delete physical file if exists
        if ($medicalRecord->attachment) {
            $path = public_path('medicalimage/' . $medicalRecord->attachment);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $medicalRecord->delete();

        return redirect()
            ->route('medicalRecord.index')
            ->with('success', 'Medical record deleted successfully.');
    }
}
