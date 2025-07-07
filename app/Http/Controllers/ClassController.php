<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        return response()->json(SchoolClass::all());
    }

    public function show($id)
    {
        $class = SchoolClass::find($id);
        if (!$class) {
            return response()->json(['message' => 'Class not found'], 404);
        }
        return response()->json($class);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'class_name' => 'required|string|max:50',
            'grade_level' => 'required|integer',
            'academic_year' => 'required|string|max:20',
            'homeroom_teacher_id' => 'nullable|exists:teachers,id',
        ]);

        $class = SchoolClass::create($validated);
        return response()->json($class, 201);
    }

    public function update(Request $request, $id)
    {
        $class = SchoolClass::find($id);
        if (!$class) {
            return response()->json(['message' => 'Class not found'], 404);
        }

        $validated = $request->validate([
            'class_name' => 'sometimes|required|string|max:50',
            'grade_level' => 'sometimes|required|integer',
            'academic_year' => 'sometimes|required|string|max:20',
            'homeroom_teacher_id' => 'nullable|exists:teachers,id',
        ]);

        $class->update($validated);
        return response()->json($class);
    }

    public function destroy($id)
    {
        $class = SchoolClass::find($id);
        if (!$class) {
            return response()->json(['message' => 'Class not found'], 404);
        }

        $class->delete();
        return response()->json(['message' => 'Class deleted']);
    }
}
