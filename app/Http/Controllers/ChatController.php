<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    // Display chat page
    public function showChat($receiverId)
    {
        $user = Auth::user();
        $receiver = User::findOrFail($receiverId);

        // Fetch the messages between the logged-in user and the receiver
        $messages = Message::where(function ($query) use ($user, $receiver) {
            $query->where('sender_id', $user->id)
                ->where('receiver_id', $receiver->id);
        })->orWhere(function ($query) use ($user, $receiver) {
            $query->where('sender_id', $receiver->id)
                ->where('receiver_id', $user->id);
        })->orderBy('created_at', 'asc')->get();

        return view('pages.chat', compact('user', 'receiver', 'messages'));
    }

    // Store a new message
    public function sendMessage(Request $request, $receiverId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $user = Auth::user();

        Message::create([
            'sender_id' => $user->id,
            'receiver_id' => $receiverId,
            'message' => $request->message,
        ]);

        return back(); // Redirect back to the chat page after sending the message
    }

    public function fetchMessages($receiverId)
    {
        $user = Auth::user();
        $receiver = User::findOrFail($receiverId);

        // Fetch messages with eager loading for sender
        $messages = Message::with('sender')
            ->where(function ($query) use ($user, $receiver) {
                $query->where('sender_id', $user->id)
                    ->where('receiver_id', $receiver->id);
            })->orWhere(function ($query) use ($user, $receiver) {
                $query->where('sender_id', $receiver->id)
                    ->where('receiver_id', $user->id);
            })->orderBy('created_at', 'asc')->get();

        // Format the 'created_at' field to show only the hour and minute
        $messages = $messages->map(function ($message) {
            $message->formatted_time = $message->created_at->format('H:i');
            return $message;
        });

        return response()->json($messages);
    }
}
