<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return response()->json(Student::all());
    }

    public function show($id)
    {
        $student = Student::find($id);
        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }
        return response()->json($student);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'person_id' => 'required|exists:persons,id',
            'enrollment_number' => 'required|string|max:20|unique:students',
            'enrollment_date' => 'nullable|date',
            'parent_id' => 'nullable|exists:persons,id',
            'current_grade_level' => 'nullable|integer',
        ]);

        $student = Student::create($validated);
        return response()->json($student, 201);
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $validated = $request->validate([
            'person_id' => 'sometimes|exists:persons,id',
            'enrollment_number' => 'sometimes|string|max:20|unique:students,enrollment_number,' . $id,
            'enrollment_date' => 'nullable|date',
            'parent_id' => 'nullable|exists:persons,id',
            'current_grade_level' => 'nullable|integer',
        ]);

        $student->update($validated);
        return response()->json($student);
    }

    public function destroy($id)
    {
        $student = Student::find($id);
        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $student->delete();
        return response()->json(['message' => 'Student deleted']);
    }
}
