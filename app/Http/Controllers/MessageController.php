<?php

namespace App\Http\Controllers;


use App\Http\Requests\MessageRequest;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;


class MessageController extends Controller
{
    public function index(User $user){
        return view('messages.index', [
            "friend" => $user
        ]);
    }

    public function showMessages(User $user){
        $messages = Message::query()->
        where('user_id_sent_message', auth()->user()->id)->
        where('user_id_received_message', $user->id)->
        orWhere('user_id_sent_message', $user->id)->
        Where('user_id_received_message', auth()->user()->id)->
        orderBy('created_at')->get();

        return json_encode($messages);
    }

    public function store(Request $request){

        Message::query()->create([
            "message" => $request->message,
            "user_id_received_message" => $request->id,
            "user_id_sent_message" => auth()->user()->id
        ]);

        return redirect(route('open-chat', [$request->id]));
    }
}
