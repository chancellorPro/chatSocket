<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Chat;
use Auth;
use DB;
use Carbon\Carbon;

class ChatController extends Controller{


    public function index(Chat $chatModel)
    {
        //$chats = Chat::all();
        //dd($chats);
        $chat = [
            'chats' => $chatModel->getPublishedChats(),
            'count' => Chat::count(),
            'users' => DB::table('users')->select('id', 'email', 'color', 'activated')->get()
        ];

        return view('chat.chat', $chat);
    }


    public function create()
    {
        return view('chat.chat');
    }

    public function userban($user_id)
    {
        DB::table('users')
            ->where('id', $user_id)
            ->update(array('activated' => 0));
        return redirect()->route('chat');
    }

    public function unban($user_id)
    {
        DB::table('users')
            ->where('id', $user_id)
            ->update(array('activated' => 1));
        return redirect()->route('chat');
    }

    public function store(Chat $chatModel, Request $request)
    {
        if (Auth::user())
        {
            $user = Auth::user();
        }

        $this->validate($request, [
            'msg' => 'required|max:200',
        ]);

        if($user['activated'] == 1)
        {

            $chat_timeout = new \DateTime();
            $chat_timeout->modify('-15 seconds');
            #echo $chat_timeout->getTimestamp();

            $old_mess = DB::table('chats')
                    ->where('user', Auth::user()->id)
                    ->where('created_at', '>=', $chat_timeout)->first();

            if (!$old_mess)
            {
                $chatModel = $chatModel->fill(
                    array_merge(
                        $request->all(),
                        ['user' => $user->id]
                    )
                );
                $chatModel->save();
            }
        }
        return redirect()->route('chat');
    }

    public function show()
    {
        //
    }

    public function update()
    {
        //
    }

}
