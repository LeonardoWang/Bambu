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
        <script src="http://localhost:6001/socket.io/socket.io.js"></script>

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
        
<!--navbar-->
<div style="margin-left:0px;margin-right:0px;">
        <nav class="navbar navbar-fixed-top" role="navigation">
            <div class="navbar-header bambu-color1">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
                <span class="sr-only">Toggle navigation</span>
              </button>
              <img id="home" onclick="javascript:window.location.href='/'" src='/img/favicon.ico'>
            </div>
            <div class="collapse navbar-collapse bambu-color1" id="navbar-collapse-01">
              <ul class="nav navbar-nav">
                <li>
                @if (isset($user) > 0)
                    <a href="/api/users_information"> hello, {{$user->name}} </a>
                </li>
                <li>
                    <a href ="/api/product">post item</a>
                @else
                    <a href="/login" >login</a>
                </li>
                <li>
                    <a href="/register" >register</a>
                @endif
                </li>
                
                <li><a href="#aboutUs">about us</a></li>
                <li><div class="navbar-form col-xs-2 col-sm-2" style="margin-left:0px;padding-left:21px;">
                    <div class="form-group">
                        <div class="input-group" >
                            <input type="text" id="inpu1" class="form-control" placeholder="Search"/>
                            <span class="input-group-btn">
                                <button onclick="sb()" class="btn"><span class="fui-search"></span></button>
                            </span>
                        </div>
                    </div>
                    </div>
                </li>
               </ul>
               @if (isset($user) > 0)
               <ul class="nav navbar-nav navbar-right" style="padding-right:20px;">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img id="bell" style="width:24px;" onmouseover="notifOnMouseOver(this)" onmouseout="notifOnMouseOut(this)" onclick="checkNotif()" src='/img/icons/svg/bell.svg'><strong class="caret"></strong></a>
                            <ul class="dropdown-menu">
                                <li>
                                     <a href="/api/trade_requests/my">Trade requests</a>
                                </li>
                                <li>
                                     <a onclick="chatroom()">Unread messages</a>
                                </li>
                                <!--<li>
                                     <a href="/api/chat_room/MyChatroom">Chat history</a>
                                </li>-->
                                <li class="divider">
                                </li>
                                <li>
                                     <a href="mailto:brucewayne@pku.edu.cn">Contact us</a>
                                </li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img id="personal-card" style="width:24px;" onmouseover="notifOnMouseOver(this)" onmouseout="notifOnMouseOut(this)" src='/img/icons/svg/personal-card.svg'><strong class="caret"></strong></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="/api/product/myProduct">My items</a>
                                </li>
                                <li>
                                     <a href="/api/users_information">Personal info</a>
                                </li>
                                <li class="divider">
                                </li>
                                <li>
                                     <a href="/logout" >Log out</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    @endif
            </div><!-- /.navbar-collapse -->
        </nav><!-- /navbar -->
    </div>

<div class="container" style="width:100%;min-height:100%;">
    <div class="row" style="width:100%;margin:0px auto 60px auto; padding:auto;">
        @yield('content')
    </div>
</div>

<footer class="footer navbar navbar-fixed-bottom" id = "aboutUs">
    @if (isset($user) > 0)
    <input type="hidden" id="userName" value="{{$user->name}}">
    <input type="hidden" id="user_id" value="{{$user->id}}">
    <div id="chatroom" style="position:absolute;bottom:10px;background-color:transparent;">
        <!--chatroom added here-->
    </div>
    @endif
    <p style="font-size:11px;margin-bottom:0px;"> copyright@Onesia Group ltd. All Rights Reserved<br>京ICP备15050380-2<br>
    <a style="font-weight:inherit;color:inherit;background-color:inherit;" href="/">homepage</a> | <a style="font-weight:inherit;color:inherit;background-color:inherit;" href="mailto:brucewayne@pku.edu.cn">contact us</a></p>
</footer>

</body>
<script src='/js/intense.js'></script>
<script type='text/javascript'>
var chatroomNum = 0;
var socket = io('http://localhost:6001');

window.onload = function() {
    //load pic zoom func
    var elements = document.querySelectorAll( '.demo-image' );
    if(elements && typeof(Intense)=="function")
        Intense( elements );
    //notif socket open when onload
    var user_id = $("#user_id").val();
    socket.on('connection', function (data) {
      //console.log(data);
      });
    socket_notif = user_id+':App\\Events\\NotifEvent';
    socket.on(socket_notif, function(data){
        if(!document.getElementById("chatroom_"+data.user_id)){
            alert('you\'ve received a new message, check it in \'Unread messages!\'');
            //notif btn
            document.getElementById('bell').src = '/img/icons/svg/bell-yellow.svg';
            $("#bell").attr({'data-container':'body', 'data-toggle': 'popover', 'data-placement': 'bottom', 'data-content': 'hello js' });
        }
    }); 
    //console.log(socket);
}


function onSubmit(id){
    var user_remote_id = id;
    var chat_room_id;

    var send_text = $("#dialog_sendtext_" + user_remote_id).val();

    $.ajax({
            type:"get",
            url:'/api/chat/GetChatRoomIDByUserID',
            data:{'user_id':user_remote_id},
            async:false,

            success:function(data){
                console.log(data);
                //console.log("user_send_id -> " + data.chat_room_id);
                chat_room_id = data.chat_room_id;
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest);
                //alert(XMLHttpRequest.status);
                //alert(XMLHttpRequest.readyState);
                console.log(textStatus); // paser error;
            }
        });

    if(send_text)
    {

        //front end display
        document.getElementById("dialog_userid_"+user_remote_id).innerHTML+=document.getElementById("userName").value+"<br>";
        document.getElementById("dialog_message_"+user_remote_id).innerHTML+=send_text + "<br>";

        $.ajax({
                type:"get",
                url:'/api/chat?chat_room_id='+chat_room_id+'&chat_infomation='+send_text ,
                //data:{'chat_room_id':chat_room_id,'chat_infomation':send_text},
                
                success:function(data){
                    console.log(data);
                    document.getElementById("dialog_sendtext_"+user_remote_id).value = "";
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(XMLHttpRequest);
                    //alert(XMLHttpRequest.status);
                    //alert(XMLHttpRequest.readyState);
                    console.log(textStatus); // paser error;
                }
        });
    }
    else{
        alert('no text!');
    }
}

function toggleChat(btn){
    var user_remote_id = btn.id.replace(/dialog_closebtn_/,"");
    var chatroom_name = "#chatroom_"+user_remote_id;
    socket.disconnect(user_remote_id + ':App\\Events\\SomeEvent', function(data){
        console.log('remove listener of chatroom '+chat_room_id);
    });

    $(chatroom_name).remove();
    chatroomNum--;
            /*if($(chatroom_id).css("display")=="none") {
                $(chatroom_id).css("display","block");
                btn.innerHTML="hide";
                //alert(document.getElementById("chatroomButton").innerHTML);
            }else {
                $(chatroom_id).css("display","none");
                btn.innerHTML="show";
            }*/
}

function createChatRoom(user_remote_id){
    var user_remote_name;
    var chat_room_id;
    var userName = $("#userName").val();
    $.ajax({
                type:"get",
                url:'/user_name/' + user_remote_id,
                data:{},
                async:false,

                success:function(data) {
                    console.log(data);
                    user_remote_name = data.name;
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(XMLHttpRequest);
                    //alert(XMLHttpRequest.status);
                    //alert(XMLHttpRequest.readyState);
                    console.log(textStatus); // paser error;
                }
    });
    chatroomNum++;

    $.ajax({
                type:"get",
                url:'/api/chat/GetChatRoomIDByUserID',
                data:{'user_id':user_remote_id},
                async:false,
                
                success:function(data){
                    console.log(data);
                    chat_room_id = data.chat_room_id;

                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(XMLHttpRequest);
                    //alert(XMLHttpRequest.status);
                    //alert(XMLHttpRequest.readyState);
                    console.log(textStatus); // paser error;
                }
    });

    if(!document.getElementById("chatroom_"+user_remote_id))
    {
        $.ajax({
                type:"get",
                url:'/api/chat/GetChatMessageByUserId',
                data:{'user_id':user_remote_id},
                async:false,

                success:function(data) {
                    console.log(data);
                    chat_room_id = data.chat_room_id;

                    document.getElementById("chatroom").innerHTML+='<div id="chatroom_'+user_remote_id+'" style="position:absolute;bottom:0px;left:400px"><div class="thumbnail" style="height:200px; overflow-y:auto;"><p style="text-align:left;font-size:13px;">chat history with '+user_remote_name+'</p><button id="dialog_closebtn_'+user_remote_id+'" onclick="toggleChat(this)" class="btn btn-xs bambu-color1" style="position:absolute;top:0px;right:0px;z-index:1000">close</button><div class="col-md-3 col-sm-3 col-xs-3 caption" id="dialog_userid_'+user_remote_id+'"></div> <div class="col-md-9 col-sm-3 col-xs-3 caption" id="dialog_message_'+user_remote_id+'"></div></div> <textarea class="thumbnail form-control" id="dialog_sendtext_'+user_remote_id+'" placeholder="reply here" onkeydown="enterToSubmit(this,event)"></textarea>      <input id="'+user_remote_id+'" onclick="onSubmit('+user_remote_id+')" class="btn btn" value="send" /></div>';

                    //show the last messages
                    for(i = 0; i < data.message.length; i++)
                    {
                        if(data.message[i].user_id==user_remote_id){
                            document.getElementById("dialog_userid_"+user_remote_id).innerHTML+=user_remote_name + "<br>";
                            document.getElementById("dialog_message_"+user_remote_id).innerHTML+=data.message[i].message + "<br>";
                        }
                        else{
                            document.getElementById("dialog_userid_"+user_remote_id).innerHTML+=userName + "<br>";
                            document.getElementById("dialog_message_"+user_remote_id).innerHTML+=data.message[i].message + "<br>";
                        }
                    }

                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(XMLHttpRequest);
                    //alert(XMLHttpRequest.status);
                    //alert(XMLHttpRequest.readyState);
                    console.log(textStatus); // paser error;
                }
        });

        //socket_chatroom1 = '1:App\\Events\\SomeEvent';
        socket_chatroom = chat_room_id + ':App\\Events\\SomeEvent';
        socket.on(socket_chatroom, function(dd){
            console.log('received a new message from ' + dd.user_id);
            console.log(dd);
            if(dd.message !== null || '')
            {
                document.getElementById("dialog_userid_" + dd.user_id).innerHTML+=user_remote_name + "<br>";
                document.getElementById("dialog_message_" + dd.user_id).innerHTML+=dd.message + "<br>";
            }
     });
    }
}

function enterToSubmit(thisTextArea,e){
    if(window.event) // IE
    {
        keynum = e.keyCode;
    }
    else if(e.which) // Netscape/Firefox/Opera
    {
        keynum = e.which;
    }

    if (keynum == 13) // press enter
    {
        id = thisTextArea.id.replace(/dialog_sendtext_/,"");
        onSubmit(id);
    }
}

function chatroom(){
    var user_id = $("#user_id").val();
    $.ajax({
            type:"get",
            url:'/api/chat_room/MyChatroom',
            data:{},
                
            success:function(data) {
                //console.log(data.message);

                for(i = 0; i < data.chat_room_array.length; i++)
                {
                    if(data.chat_room_array[i].user_sell_id !== data.chat_room_array[i].user_buy_id) 
                        if(data.chat_room_array[i].user_sell_id != user_id)
                            createChatRoom(data.chat_room_array[i].user_sell_id);
                        else if(data.chat_room_array[i].user_buy_id !== user_id)
                            createChatRoom(data.chat_room_array[i].user_buy_id);
                }

            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest);
                //alert(XMLHttpRequest.status);
                //alert(XMLHttpRequest.readyState);
                console.log(textStatus); // paser error;
            }
        });
}
</script>
<script src="/js/basic.js"></script>
</html>