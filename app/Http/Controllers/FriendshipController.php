<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\User;
use Illuminate\Http\Request;

class FriendshipController extends Controller
{
    public function index(){
        $users = auth()->user()->friends;
        $friends = User::query()->whereIn('id', $users )->get();

        return view('friendships.index', [
            "friends" => $friends
        ]);
    }

    public function sendRequest(User $user){
        Friendship::create([
            'user_id_sent_request' => auth()->user()->id,
            'user_id_received_request' => $user->id
        ]);

        return redirect(route('index'));
    }

    public function acceptFriendshipRequest(User $user){
        Friendship::query()->
        where('user_id_sent_request', $user->id)->
        where('user_id_received_request', auth()->
        user()->id)->update([
            'status' => 1
        ]);

        return redirect(route('index'));
    }

    public function removeFriendshipRequest(User $user){
        Friendship::query()->
        where('user_id_sent_request', auth()->
        user()->id)->
        where('user_id_received_request', $user->id)->delete();

        return redirect(route('index'));
    }

    public function ignoreFriendshipRequest(User $user){
        Friendship::query()->
        where('user_id_sent_request', $user->id)->
        where('user_id_received_request', auth()->
        user()->id)->delete();

        return redirect(route('index'));
    }

    public function friendshipRequests(){
        $friendship_requests = User::query()->whereIn('id', auth()->user()->friendship_requests )->get();

        return view('friendships.friendship-requests', [
            "friendship_requests" => $friendship_requests
        ]);
    }

    public function friendshipRequestsSent(){
        return view('friendships.friendship-requests-sent', [
            "friendship_requests_sent" => User::find(auth()->user()->friendshipsSent()->where('status', 0)->get('user_id_received_request'))
        ]);
    }
}

