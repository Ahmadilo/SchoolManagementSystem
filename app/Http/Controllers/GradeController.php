<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index()
    {
        return response()->json(Grade::all());
    }

    public function show($id)
    {
        $grade = Grade::find($id);
        if (!$grade) {
            return response()->json(['message' => 'Grade not found'], 404);
        }
        return response()->json($grade);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'class_subject_id' => 'required|exists:class_subjects,id',
            'grade_type' => 'required|string|in:Exam,Quiz,Homework,Project',
            'grade_date' => 'required|date',
            'score' => 'required|numeric|min:0|max:999.99',
            'max_score' => 'required|numeric|min:1|max:999.99',
            'weight' => 'required|numeric|min:0|max:100',
            'comments' => 'nullable|string|max:200',
        ]);

        $grade = Grade::create($validated);
        return response()->json($grade, 201);
    }

    public function update(Request $request, $id)
    {
        $grade = Grade::find($id);
        if (!$grade) {
            return response()->json(['message' => 'Grade not found'], 404);
        }

        $validated = $request->validate([
            'student_id' => 'sometimes|required|exists:students,id',
            'class_subject_id' => 'sometimes|required|exists:class_subjects,id',
            'grade_type' => 'sometimes|required|string|in:Exam,Quiz,Homework,Project',
            'grade_date' => 'sometimes|required|date',
            'score' => 'sometimes|required|numeric|min:0|max:999.99',
            'max_score' => 'sometimes|required|numeric|min:1|max:999.99',
            'weight' => 'sometimes|required|numeric|min:0|max:100',
            'comments' => 'nullable|string|max:200',
        ]);

        $grade->update($validated);
        return response()->json($grade);
    }

    public function destroy($id)
    {
        $grade = Grade::find($id);
        if (!$grade) {
            return response()->json(['message' => 'Grade not found'], 404);
        }

        $grade->delete();
        return response()->json(['message' => 'Grade deleted']);
    }
}
