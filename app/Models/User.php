<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function friendshipsSent(){
        return $this->hasMany(Friendship::class, 'user_id_sent_request');
    }

    public function friendshipsReceived(){
        return $this->hasMany(Friendship::class, 'user_id_received_request');
    }

    public function messagesSent(){
        return $this->hasMany(Message::class, 'user_id_sent_message');
    }

    public function messagesReceived(){
        return $this->hasMany(Message::class, 'user_id_received_message');
    }

    public function getNotFriendsAttribute(){
        $users = [];
        $i = 0;
        $notFriends = $this->friendshipsSent()->get('user_id_received_request');
      if(count($notFriends) > 0){
          foreach($notFriends as $nf){
              $users[$i++] = $nf->user_id_received_request;
          }
      }
       $notFriends = $this->friendshipsReceived()->get('user_id_sent_request');
       if(count($notFriends) >0){
           foreach($notFriends as $nf){
               $users[$i++] = $nf->user_id_sent_request;
           }
       }

        return $users;
    }

    public function getFriendsAttribute(){

        $friends = [];

        $friends1 = $this->friendshipsSent()->where('status', 1)->get('user_id_received_request')->toArray();

        if(count($friends1) > 0){
           $friends = $friends1;
        }

        $friends2 = $this->friendshipsReceived()->where('status', 1)->get('user_id_sent_request')->toArray();

        if(count($friends2) > 0){
            $friends = array_merge($friends2, $friends);
       }
       
        return $friends;
    }

    public function getFriendshipRequestsAttribute(){
        return $this->friendshipsReceived()->where('status', 0)->get('user_id_sent_request');;
    }

}
