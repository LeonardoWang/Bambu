<!DOCTYPE html>
<html>
    <head>
        <title>Bambu, your idle items trading app</title>

        <meta charset="utf-8">
        <meta name="baidu-site-verification" content="X5TO9MtQAq" />
        <meta name="description" content="Bambu, your idle items trading app."/>
        <meta name="keywords" content="Bambu, second hand, idle item"/>
        <meta name="robots" content="all" />
        <meta name="author" content="Marc Wang and Leonardo Wang" />
        <meta name="viewport" content="width=100%, initial-scale=1.0, maximum-scale=1.0">

        <script src="/js/jquery-3.1.1.min.js"></script>
        <script src="http://thebambu.com:6001/socket.io/socket.io.js"></script>

        <!-- Loading Bootstrap -->
        <link href="/Flat-UI-master/dist/css/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Loading Flat UI -->
        <script src="/Flat-UI-master/dist/js/flat-ui.min.js"></script>
        <link href="/Flat-UI-master/dist/css/flat-ui.css" rel="stylesheet">

        <!-- Loading mycss -->
        <link href="/css/mycss.css" rel="stylesheet">
        <link rel="shortcut icon" href="/img/favicon.ico">

    </head>
    <body>
        
@extends('navbar')

<div class="container" style="width:100%;">
    <div class="row" style="width:100%;margin:58px auto 0px auto; padding:auto;">
        @yield('content')
    </div>
</div>

<div id="chatroom" style="position:absolute;bottom:10px;">
    <!--chatroom added here-->
    <div id="chatroom_user"></div>
</div>

</body>
<script src="/js/sms.js"></script>
<script src="/js/chat.js"></script>
<script src="/js/basic.js"></script>
<!--<script>
$('li.dropdown').mouseover(function() { 
    $(this).addClass('open');}); 
</script>-->
</html>