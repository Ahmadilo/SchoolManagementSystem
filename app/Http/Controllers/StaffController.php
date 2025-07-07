<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        return response()->json(Staff::all());
    }

    public function show($id)
    {
        $staff = Staff::find($id);
        if (!$staff) {
            return response()->json(['message' => 'Staff not found'], 404);
        }
        return response()->json($staff);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'person_id' => 'required|exists:persons,id',
            'staff_number' => 'required|string|max:20|unique:staff',
            'hire_date' => 'nullable|date',
            'position' => 'nullable|string|max:50',
            'department' => 'nullable|string|max:50',
            'salary' => 'nullable|numeric|min:0',
        ]);

        $staff = Staff::create($validated);
        return response()->json($staff, 201);
    }

    public function update(Request $request, $id)
    {
        $staff = Staff::find($id);
        if (!$staff) {
            return response()->json(['message' => 'Staff not found'], 404);
        }

        $validated = $request->validate([
            'person_id' => 'sometimes|exists:persons,id',
            'staff_number' => 'sometimes|string|max:20|unique:staff,staff_number,' . $id,
            'hire_date' => 'nullable|date',
            'position' => 'nullable|string|max:50',
            'department' => 'nullable|string|max:50',
            'salary' => 'nullable|numeric|min:0',
        ]);

        $staff->update($validated);
        return response()->json($staff);
    }

    public function destroy($id)
    {
        $staff = Staff::find($id);
        if (!$staff) {
            return response()->json(['message' => 'Staff not found'], 404);
        }

        $staff->delete();
        return response()->json(['message' => 'Staff deleted']);
    }
}
