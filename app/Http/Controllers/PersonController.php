<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use Illuminate\Support\Facades\Log;
use Symfony\Component\ErrorHandler\Debug;

use function Psy\debug;

class PersonController extends Controller
{
    public function PersonValidation(Request $request, $id = null)
    {
        $rules = [
            'user_id' => 'nullable|integer|exists:users,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string|in:male,female,unKnown',
            'email' => 'nullable|email|max:255|unique:persons,email' . ($id ? ",$id,id" : ''),
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        return $request->validate($rules);
    }

    public function store(Request $request)
    {
        //debug($request->all());
        $validated = $this->PersonValidation($request);
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
        //Debug($request->all());
        Log::debug("Updating person with ID: $id");
        $person = Person::find($id);
        $person->user_id = 2;

        if (!$person) {
            return response()->json(['message' => 'Person not found'], 404);
        }
        Log::debug("Person found: ", ['person' => $person]);
        $validated = $this->PersonValidation($request, $id);

        Log::debug("Validated data: ", ['validated' => $validated]);
        $person->update($validated);

        Log::debug("Person updated: ", ['person' => $person], "\n\n\n\n");
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
