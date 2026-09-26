<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Doctor::with('user', 'department')->latest()->get();
        return view('doctors.index', compact('doctors'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        return view('doctors.create', compact('departments'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'phone' => 'required|string|max:20',
            'department_id' => 'required|exists:departments,id',
            'specialization' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'experience' => 'required|integer|min:0',
            'consultation_fee' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'role' => 'doctor',
            'status' => $validated['status'],
        ]);

        Doctor::create([
            'user_id' => $user->id,
            'department_id' => $validated['department_id'],
            'specialization' => $validated['specialization'],
            'qualification' => $validated['qualification'],
            'experience' => $validated['experience'],
            'consultation_fee' => $validated['consultation_fee'],
        ]);

        return redirect()
            ->route('doctors.index')
            ->with('success', 'Doctor created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        $doctor->load('user', 'department');
        return view('doctors.show', compact('doctor'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        $departments = Department::all();
        $doctor->load('user');
        return view('doctors.edit', compact('doctor', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $doctor->user_id,
            'password' => 'nullable|string|min:8',
            'phone' => 'required|digits:10',
            'department_id' => 'required|exists:departments,id',
            'specialization' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'experience' => 'required|integer|min:0',
            'consultation_fee' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        // Update user account
        $userData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'status' => $validated['status'],
        ];

        // Only update password if a new one was provided
        if (!empty($validated['password'])) {
            $userData['password'] = Hash::make($validated['password']);
        }

        $doctor->user->update($userData);

        // Update doctor record
        $doctor->update([
            'department_id' => $validated['department_id'],
            'specialization' => $validated['specialization'],
            'qualification' => $validated['qualification'],
            'experience' => $validated['experience'],
            'consultation_fee' => $validated['consultation_fee'],
        ]);

        return redirect()
            ->route('doctors.index')
            ->with('success', 'Doctor Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        $doctor->user->delete();
        return redirect()->route('doctors.index')->with('success', 'Doctor Deleted Successfully.');
    }
}
