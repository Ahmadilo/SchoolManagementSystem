<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        return response()->json(Notification::all());
    }

    public function show($id)
    {
        $notification = Notification::find($id);
        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], 404);
        }
        return response()->json($notification);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sender_id' => 'required|exists:users2,id',
            'receiver_id' => 'required|exists:users2,id',
            'title' => 'required|string|max:100',
            'message' => 'required|string|max:500',
            'sent_date' => 'nullable|date',
            'is_read' => 'nullable|boolean',
        ]);

        if (!isset($validated['sent_date'])) {
            $validated['sent_date'] = now();
        }

        $notification = Notification::create($validated);
        return response()->json($notification, 201);
    }

    public function update(Request $request, $id)
    {
        $notification = Notification::find($id);
        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:100',
            'message' => 'sometimes|required|string|max:500',
            'is_read' => 'sometimes|required|boolean',
        ]);

        $notification->update($validated);
        return response()->json($notification);
    }

    public function destroy($id)
    {
        $notification = Notification::find($id);
        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], 404);
        }

        $notification->delete();
        return response()->json(['message' => 'Notification deleted']);
    }
}
