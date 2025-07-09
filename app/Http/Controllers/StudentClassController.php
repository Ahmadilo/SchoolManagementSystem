<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class StudentClassController extends Controller
{
    public function index()
    {
        return response()->json(StudentClass::all());
    }

    public function show($id)
    {
        $record = StudentClass::find($id);
        if (!$record) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        return response()->json($record);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'class_id' => 'required|exists:classes,id',
            'enrollment_date' => 'nullable|date',
        ]);

        // إذا ما أرسل تاريخ، خليه اليوم
        if (!$validated['enrollment_date']) {
            $validated['enrollment_date'] = now()->toDateString();
        }

        $record = StudentClass::create($validated);
        return response()->json($record, 201);
    }

    public function update(Request $request, $id)
    {
        $record = StudentClass::find($id);
        if (!$record) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        $validated = $request->validate([
            'student_id' => 'sometimes|required|exists:students,id',
            'class_id' => 'sometimes|required|exists:classes,id',
            'enrollment_date' => 'nullable|date',
        ]);

        $record->update($validated);
        return response()->json($record);
    }

    public function destroy($id)
    {
        $record = StudentClass::find($id);
        if (!$record) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        $record->delete();
        return response()->json(['message' => 'StudentClass deleted']);
    }
}
