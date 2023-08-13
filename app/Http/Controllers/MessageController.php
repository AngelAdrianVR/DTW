<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function index()
    {
        $messages = Message::latest()->get();
        return inertia('Messenger/Index', compact('messages'));
    }

    public function store(Request $request)
    {   
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'nullable|string|min:10|max:10',
            'message' => 'required',
            'service' => 'nullable|string',
            'info' => 'boolean',
        ]); 

        Message::create($request->all());

        return back();

    }

    public function MarkAsdispatched(Request $request)
    {
        foreach ($request->messages as $message) {
            $message = Message::find($message['id']);
            $message->status = Message::DISPATCHED;
            $message->save();
        }

        return response()->json(['message' => 'mensajes marcados como despachados']);
    }

    public function massiveDelete(Request $request)
    {
        foreach ($request->messages as $message) {
            $message = Message::find($message['id']);
            $message->delete();
        }

        return response()->json(['message' => 'mensaje(s) eliminado(s)']);
    }
}
