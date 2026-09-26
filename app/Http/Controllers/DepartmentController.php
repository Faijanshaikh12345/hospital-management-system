<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::latest()->get();

        return view('departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:departments,code',
            'status' => 'required|in:active,inactive',
            'description' => 'nullable|string',
        ]);

        Department::create([
            'name' => $validated['name'],
            'code' => $validated['code'],
            'status' => $validated['status'],
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()
            ->route('departments.index')
            ->with('success', 'Departments created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        return view('departments.show' , compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:departments,code,' . $department->id,
            'status' => 'required|in:active,inactive',
            'description' => 'nullable|string',
        ]);

        $department->name = $validated['name'];
        $department->code = $validated['code'];
        $department->status = $validated['status'];
        $department->description = $validated['description'] ?? null;
        $department->save();
        return redirect()->route('departments.index')->with('success' , 'Department updated successfully.');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('departments.index')->with('success' , 'Department Deleted successfully.');

    }
}
