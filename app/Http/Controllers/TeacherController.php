<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log as FacadesLog;

class TeacherController extends Controller
{
    public function index()
    {
        Log::info("The Reqoust arive here.");
        return response()->json(Teacher::all());
    }

    public function show($id)
    {
        $teacher = Teacher::find($id);
        if (!$teacher) {
            return response()->json(['message' => 'Teacher not found'], 404);
        }
        return response()->json($teacher);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'subject_specialization' => 'nullable|string|max:100',
        ]);

        $teacher = Teacher::create($validated);
        return response()->json($teacher, 201);
    }

    public function update(Request $request, $id)
    {
        $teacher = Teacher::find($id);
        if (!$teacher) {
            return response()->json(['message' => 'Teacher not found'], 404);
        }

        $validated = $request->validate([
            'staff_id' => 'sometimes|exists:staff,id',
            'subject_specialization' => 'nullable|string|max:100',
        ]);

        Log::info('Updating teacher with ID: ' . $id, ['data' => $validated]);

        $teacher->staff_id = $validated['staff_id'];
        $teacher->subject_specialization = $validated['subject_specialization'];


        Log::info('Updating teacher subject: ' . $teacher->subject_specialization, ['teacher_id' => $teacher->id]);


        // for test
        //$teacher->subject_specialization = 'Mathematics'; // Default value for testing
        Log::info('Updating teacher subject: ' . $teacher->subject_specialization, ['teacher_id' => $teacher->id]);


        $teacher->save();
        return response()->json($teacher);
    }

    public function destroy($id)
    {
        $teacher = Teacher::find($id);
        if (!$teacher) {
            return response()->json(['message' => 'Teacher not found'], 404);
        }

        $teacher->delete();
        return response()->json(['message' => 'Teacher deleted']);
    }
}
