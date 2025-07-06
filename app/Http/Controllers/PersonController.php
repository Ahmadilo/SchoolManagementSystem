<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;

use function Psy\debug;

class PersonController extends Controller
{
    public function PersonValidtion(Request $request)
    {
        return $request->validate([
            'user_id' => 'nullable|integer|exists:users2,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string|in:male,female,unKnown',
            'email' => 'nullable|email|max:255|unique:persons,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    }

    public function store(Request $request)
    {
        //debug($request->all());
        $validated = $this->PersonValidtion($request);
        // $validated = $request->only([
        //     'user_id',
        //     'first_name',
        //     'last_name',
        //     'date_of_birth',
        //     'gender',
        //     'email',
        //     'phone',
        //     'address',
        // ]);

        /**
         * @var \App\Models\Person $person
         */
        $person = new Person($validated);
        $person->save();

        return response()->json([
            'message' => 'Person created successfully',
            'person' => $person
        ], 201);
    }

    public function index()
    {
        $people = Person::all();

        return response()->json([
            'message' => 'People fetched successfully',
            'people' => $people
        ]);
    }

    public function update(Request $request, $id)
    {
        $person = Person::find($id);

        if (!$person) {
            return response()->json(['message' => 'Person not found'], 404);
        }

        $validated = $this->PersonValidtion($request);

        $person->update($validated);

        return response()->json([
            'message' => 'Person updated successfully',
            'person' => $person
        ]);
    }

    public function show($id)
    {
        $person = Person::find($id);

        if (!$person) {
            return response()->json(['message' => 'Person not found'], 404);
        }

        return response()->json([
            'message' => 'Person fetched successfully',
            'person' => $person
        ]);
    }

    public function destroy($id)
    {
        $person = Person::find($id);

        if (!$person) {
            return response()->json(['message' => 'Person not found'], 404);
        }

        $person->delete();

        return response()->json([
            'message' => 'Person deleted successfully'
        ]);
    }
}
