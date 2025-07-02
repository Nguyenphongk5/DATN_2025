<?php
namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate(['content' => 'required|string|max:1000']);
        $message = Message::create([
            'user_id' => Auth::id(),
            'support_id' => null,
            'content' => $request->content,
            'type' => 'text',
        ]);
        broadcast(new MessageSent($message));
        return response()->json(['status' => 'Message sent']);
    }

    public function getMessages()
    {
        $messages = Message::where('user_id', Auth::id())->with('user')->get();
        return response()->json($messages);
    }
}