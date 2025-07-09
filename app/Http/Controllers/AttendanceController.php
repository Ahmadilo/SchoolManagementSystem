<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        return response()->json(Attendance::all());
    }

    public function show($id)
    {
        $attendance = Attendance::find($id);
        if (!$attendance) {
            return response()->json(['message' => 'Attendance record not found'], 404);
        }
        return response()->json($attendance);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'class_subject_id' => 'required|exists:class_subjects,id',
            'date' => 'required|date',
            'status' => 'required|string|in:Present,Absent,Late,Excused',
            'notes' => 'nullable|string|max:200',
        ]);

        $attendance = Attendance::create($validated);
        return response()->json($attendance, 201);
    }

    public function update(Request $request, $id)
    {
        $attendance = Attendance::find($id);
        if (!$attendance) {
            return response()->json(['message' => 'Attendance record not found'], 404);
        }

        $validated = $request->validate([
            'student_id' => 'sometimes|required|exists:students,id',
            'class_subject_id' => 'sometimes|required|exists:class_subjects,id',
            'date' => 'sometimes|required|date',
            'status' => 'sometimes|required|string|in:Present,Absent,Late,Excused',
            'notes' => 'nullable|string|max:200',
        ]);

        $attendance->update($validated);
        return response()->json($attendance);
    }

    public function destroy($id)
    {
        $attendance = Attendance::find($id);
        if (!$attendance) {
            return response()->json(['message' => 'Attendance record not found'], 404);
        }

        $attendance->delete();
        return response()->json(['message' => 'Attendance record deleted']);
    }
}
