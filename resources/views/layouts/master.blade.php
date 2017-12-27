<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        @section('title')
            Php chat
        @show
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSS are placed here -->
    {{ Html::style('css/bootstrap.css') }}
    {{ Html::style('css/bootstrap-theme.css') }}
    {{ Html::style('css/chat.css') }}

    <style>
        @section('styles')
            body {
            padding-top: 60px;
        }
        @show
    </style>
</head>

<body>
<!-- Navbar -->
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

        </div>
        <!-- Everything you want hidden at 940px or less, place within here -->
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav ml6">
                <li><a href="{{{ URL::to('') }}}">Home</a></li>
                @if (isset(Auth::user()->id) && (Auth::user()->id== 1))
                    <li><a class="admin">Admin</a></li>
                @endif
                @if (Auth::user())
                <li>{!! HTML::link('/logout', 'Logout', array('class' => 'fa fa-sign-out fa-fw')) !!}</li>
                @else
                    <li><a href="auth/login" class="">Sign in</a></li>
                    <li><a href="http://chat.loc/register" class="">Registration</a></li>
                @endif
                <li id="hello"></li>
            </ul>
        </div>
    </div>
</div>

<!-- Container -->
<div class="container">

    <!-- Content -->
    @yield('content')

</div>

<!-- Scripts are placed here -->
{{ Html::script('js/jquery-1.11.1.min.js') }}
{{ Html::script('js/bootstrap.min.js') }}
<script>
    var conn = new WebSocket('ws://chat.loc:8080');
    conn.onopen = function (e) {
        var hello = document.getElementById('hello');
        hello.innerHTML = 'New connection';
    }
    conn.onmessage = function (e) {
        var hello = document.getElementById('chat_list');
        hello.innerHTML = '<span> user: user@email </span><p>' + e.data +'</p>';

        console.log("Get data: " + e.data);
    }
    function send() {
        var data =  document.getElementById('msg').value;
        conn.send(data);
        //console.log('Sended: ' + data);
    }
</script>
</body>
</html>