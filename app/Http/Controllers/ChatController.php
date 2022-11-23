<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function chats()
    {
        //$chats = Auth::user()->chat;
        $messagesToYou = Chat::all()->where('recipient_id', Auth::user()->id);
        $messagesFromYou = Chat::all()->where('user_id', Auth::user()->id);
        //there are all messages to you and from you
        $chats = $messagesToYou->concat($messagesFromYou);
        //maybe need to find recipients from them
        $recipients = collect();
        foreach ($chats as $chat){
            if($chat->recipient_id != Auth::user()->id) $recipients->push(User::find($chat->recipient_id));
        }
        //only unique
        $recipients = $recipients->unique();
        //and senders?
        $senders = collect();
        foreach ($chats as $chat){
            if($chat->user_id != Auth::user()->id) $senders->push(User::find($chat->user_id));
        }
        //only unique
        $senders = $senders->unique();
        //what next?
        $users = $recipients->concat($senders)->unique();
        //find last messages of these users somehow
        $lastMessages = collect();
        foreach ($users as $user){
            $lastMessages->push(Chat::where('recipient_id', $user->id)->orWhere('user_id', $user->id)->get()->last()->message);
        }


        return view('users.chats', compact('users', 'lastMessages'));
    }

    public function dialogue($id)
    {
        $recipient = User::find($id);
        //need to check if recipient messages is for user
        $recipientMessages = $recipient->chat->where('recipient_id', Auth::user()->id);
        //need to check if user messages is for recipient
        $userMessages = Auth::user()->chat->where('recipient_id', $id);

        $messages = $recipientMessages->concat($userMessages)->sortBy('created_at');
        return view('users.dialogue', compact('messages', 'recipient'));
    }
    public function sendMessage(Request $request)
    {
        Chat::create([
            'user_id'=>Auth::user()->id,
            'recipient_id'=> $request->validate(['recipient'=>'required'])['recipient'],
            'message'=> $request->validate(['message'=>'required'])['message']
        ]);
        return back();
    }
}
