<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        return response()->json(Subject::all());
    }

    public function show($id)
    {
        $subject = Subject::find($id);
        if (!$subject) {
            return response()->json(['message' => 'Subject not found'], 404);
        }
        return response()->json($subject);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject_name' => 'required|string|max:100',
            'subject_code' => 'required|string|max:20|unique:subjects',
            'description' => 'nullable|string|max:500',
            'department' => 'nullable|string|max:50',
        ]);

        $subject = Subject::create($validated);
        return response()->json($subject, 201);
    }

    public function update(Request $request, $id)
    {
        $subject = Subject::find($id);
        if (!$subject) {
            return response()->json(['message' => 'Subject not found'], 404);
        }

        $validated = $request->validate([
            'subject_name' => 'sometimes|required|string|max:100',
            'subject_code' => 'sometimes|required|string|max:20|unique:subjects,subject_code,' . $id,
            'description' => 'nullable|string|max:500',
            'department' => 'nullable|string|max:50',
        ]);

        $subject->update($validated);
        return response()->json($subject);
    }

    public function destroy($id)
    {
        $subject = Subject::find($id);
        if (!$subject) {
            return response()->json(['message' => 'Subject not found'], 404);
        }

        $subject->delete();
        return response()->json(['message' => 'Subject deleted']);
    }
}
