<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $users = auth()->user()->not_friends;
        $users[] = auth()->user()->id;
        $not_friends = User::query()->whereNotIn('id', $users )->get();

        return view('home.index', [
            "not_friends" => $not_friends
        ]);
    }

//    public function friendshipRequests(){
//        $friendship_requests = User::query()->whereIn('id', auth()->user()->friendship_requests )->get();
//
//        return view('home.friendship-requests', [
//            "friendship_requests" => $friendship_requests
//        ]);
//    }
//
//    public function friendshipRequestsSent(){
//        return view('home.friendship-requests-sent', [
//            "friendship_requests_sent" => User::find(auth()->user()->friendshipsSent()->where('status', 0)->get('user_id_received_request'))
//        ]);
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

}
