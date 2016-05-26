@extends('layouts.master')

@section('content')
    <div class="row">
        <!-- Chat list -->
        <div class="col-md-9 col-md-offset-1 user_list">

            <span class="mcount">{{ $count }} messages</span>
            <div class="botbox col-md-11">
                @foreach($chats as $chat)
                    <article id="chat_list">
                        <strong style="color:#{{$chat->color}}">{{ $chat->name or 'Delete user'}}:</strong>
                        <i>{{ $chat->created_at }}</i>
                        <p style="color:#{{$chat->color}}">{{ $chat->msg }}</p>
                    </article>
                @endforeach


                @if (!Auth::guest())
                     {{Form::open(array('method' => 'post', 'onsubmit' => 'send()'))}}
                        <input type="text" name="msg" id="msg" class="col-md-10" placeholder="maximum 200 simbols" />
                        <input type="submit" value="Send message" class="col-md-2">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     {{ Form::close() }}
                @endif
            </div>
        </div>
        <!-- /Chat list -->
        <!-- User list only for admin -->
        <div class="col-md-2 user_list">
            @if (isset(Auth::user()->id) && (Auth::user()->id== 1))
                User list:
                <ul id="chat_list">
                    @foreach($users as $user)
                        @if($user->activated==1)
                            <li><a href="userban/{{$user->id}}">{{ $user->email }}</a></li>
                        @else
                            <li><a href="unban/{{$user->id}}" class="admin">{{ $user->email }}</a></li>
                        @endif
                    @endforeach
            @endif
            </ul>
        </div>
        <!-- /User list only for admin -->
    </div>


@stop
