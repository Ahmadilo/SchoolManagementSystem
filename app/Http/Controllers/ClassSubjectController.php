<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ClassSubject;
use Illuminate\Http\Request;

class ClassSubjectController extends Controller
{
    public function index()
    {
        return response()->json(ClassSubject::all());
    }

    public function show($id)
    {
        $record = ClassSubject::find($id);
        if (!$record) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        return response()->json($record);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'class_id' => 'required|exists:classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:teachers,id',
            'schedule_day' => 'required|string|max:10',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'room_number' => 'nullable|string|max:20',
        ]);

        $record = ClassSubject::create($validated);
        return response()->json($record, 201);
    }

    public function update(Request $request, $id)
    {
        $record = ClassSubject::find($id);
        if (!$record) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        $validated = $request->validate([
            'class_id' => 'sometimes|required|exists:classes,id',
            'subject_id' => 'sometimes|required|exists:subjects,id',
            'teacher_id' => 'sometimes|required|exists:teachers,id',
            'schedule_day' => 'sometimes|required|string|max:10',
            'start_time' => 'sometimes|required|date_format:H:i',
            'end_time' => 'sometimes|required|date_format:H:i|after:start_time',
            'room_number' => 'nullable|string|max:20',
        ]);

        $record->update($validated);
        return response()->json($record);
    }

    public function destroy($id)
    {
        $record = ClassSubject::find($id);
        if (!$record) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        $record->delete();
        return response()->json(['message' => 'ClassSubject deleted']);
    }
}
