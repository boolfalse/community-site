<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\ChatEvent;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function chats()
    {
        $user = User::find(Auth::id());

        return view('chat.chats', compact('user'));
    }

    public function send(Request $request)
    {
        $message = $request->message;
        $user = User::find(Auth::id());

        event(new ChatEvent($message, $user->name));
    }
}
