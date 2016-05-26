<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $guarded = ['_token'];
    //protected $guarded = [];
    public function getPublishedChats()
    {
        //$chat = Chat::latest('published')->get();
        $chat = DB::table('chats')
            ->leftJoin('users', 'users.id', '=', 'chats.user')
            ->get();
        return $chat;
    }
}
