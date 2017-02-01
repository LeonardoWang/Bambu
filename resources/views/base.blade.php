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
        <script src='/js/intense.js'></script>
        <script src="http://localhost:6001/socket.io/socket.io.js"></script>
   
        <!-- Loading Bootstrap -->
        <link href="/Flat-UI-master/dist/css/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Loading Flat UI -->
        <script src="/Flat-UI-master/dist/js/flat-ui.min.js"></script>
        <link href="/Flat-UI-master/dist/css/flat-ui.css" rel="stylesheet">

        <!-- Loading mycss -->
        <link href="/css/mycss.css" rel="stylesheet">
        <link rel="shortcut icon" href="/img/favicon.ico">

        <!-- bambu-color1:#e53935;
        bambu-color2:#f44336;
        grey:#bdc3c7;
    -->
    </head>

    <body>
<!--navbar-->
<div style="margin-left:0px;margin-right:0px;">
        <nav class="navbar navbar-fixed-top" role="navigation">
            <div class="navbar-header bambu-color1">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
                <span class="sr-only">Toggle navigation</span>
              </button>
              <img id="home" onclick="home()" src='/img/favicon.ico'>
            </div>
            <div class="collapse navbar-collapse bambu-color1" id="navbar-collapse-01">
              <ul class="nav navbar-nav">
                <li>
                @if (isset($user) > 0)
                    <a href="/api/users_information"> hello, {{$user->name}} </a></li><li>
                    <a href="/logout" >logout</a>
                @else
                    <a href="/login" >login</a>
                @endif
                </li>
                <li>
                    <a href ="/api/product">post item</a>
                </li>
                <li>
                    <a href="/api/product/myProduct">my items</a>
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
            </div><!-- /.navbar-collapse -->
          </nav><!-- /navbar -->
    </div>

<div class="container" style="width:100%;min-height:100%;">
    <div class="row" style="width:100%;margin:58px auto 0px auto; padding:auto;">
        @yield('content')
    </div>
</div>

<footer class="footer navbar navbar-fixed-bottom" id = "aboutUs">
    @if (isset($user) > 0)
    <input type="hidden" id="userName" value="{{$user->name}}"></input>
    <div id="chatroom" style="position:absolute;bottom:10px;background-color:transparent;">
        <!--chatroom added here-->
    </div>
    @endif
    <p style="font-size:11px;margin-bottom:0px;"> copyright@Onesia Group ltd. All Rights Reserved<br>京ICP备15050380-2<br>
    <a style="font-weight:inherit;color:inherit;background-color:inherit;" href="/">homepage</a> | <a style="font-weight:inherit;color:inherit;background-color:inherit;" href="mailto:brucewayne@pku.edu.cn">contact us</a></p>
</footer>

</body>
    <script type="text/javascript">
        window.onload = function() {
            var elements = document.querySelectorAll( '.demo-image' );
            Intense( elements );
            var socket = io('http://localhost:6001');
            var chatroomNum=0;
            socket.on('connection', function (data) {
                console.log(data);
            });
            socket.on('2:App\\Events\\SomeEvent', function(message){
                console.log(message);
                if(!document.getElementById("chatroom_"+message.user_id))//create a chatroom
                {
                    chatroomNum++;
                    console.log("chatroomnumber: " + chatroomNum);
                    document.getElementById("chatroom").innerHTML+='<div id="chatroom_'+message.user_id+'" style="float:right">     <div class="thumbnail" style="height:200px;">     <button id="dialog_closebtn_'+message.user_id+'" onclick="toggleChat(this)" class="btn btn-xs bambu-color1" style="position:absolute;top:0px;right:0px;z-index:1000">close</button>                                                              <div class="col-md-3 caption" id="dialog_userid_'+message.user_id+'"></div>                                 <div class="col-md-9 caption" id="dialog_message_'+message.user_id+'"></div>                                </div>                                                                                                      <textarea class="thumbnail form-control" id="dialog_sendtext_'+message.user_id+'" placeholder="reply here"></textarea>                                                                                                  <div><input id="'+message.user_id+'" onclick="onSubmit(this)" class="btn" value="send" /></div></div>';
                }
                document.getElementById("dialog_userid_"+message.user_id).innerHTML+=message.user_id + "<br>";
                document.getElementById("dialog_message_"+message.user_id).innerHTML+=message.message + "<br>";
            });
            console.log(socket);
        }
        /*function turnpage(id){

            window.location.href="/";
        }*/

    
        function sb(){
            s = document.getElementById('inpu1').value;
            if(s){
            window.location.href="/api/items/search/" + s;
            }
            else
                alert("the search field can't be empty"); 
        }

        function home(){
            window.location.href="/";
        }

        function onSubmit(btn){
            var user_remote_id = btn.id;
            var chat_room_id;
            var send_text = document.getElementById("dialog_sendtext_"+user_remote_id).value;
            if(send_text)
            {
                document.getElementById("dialog_userid_"+user_remote_id).innerHTML+=document.getElementById("userName").value+"<br>";
                document.getElementById("dialog_message_"+user_remote_id).innerHTML+=send_text + "<br>";
                
                $.ajax({
                type:"get",
                url:'/api/chat/GetChatRoomIDByUserID',
                data:{'user_id':user_remote_id},
                
                success:function(msg){
                    //console.log(user_send_id + " -> " + msg.chat_room_id);
                    console.log(msg);
                    //chat_room_id = msg.chat_room_id;
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(XMLHttpRequest);
                    //alert(XMLHttpRequest.status);
                    //alert(XMLHttpRequest.readyState);
                    //alert(textStatus); // paser error;
                }
                });


                $.ajax({
                type:"post",
                url:'/api/chat',
                data:{'chat_room_id':chat_room_id,
                    'chat_infomation':send_text},
                
                success:function(msg){
                    console.log(msg);
                    /*document.getElementById("code").value = msg.substr(0,4);
                    if(msg.substr(13,3)=='100'){
                        alert('SMS code has sent!');
                    }else{
                        alert('SMS code sent failed, check your network.');
                    }*/
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(XMLHttpRequest);
                    //alert(XMLHttpRequest.status);
                    //alert(XMLHttpRequest.readyState);
                    //alert(textStatus); // paser error;
                }
                });
            }
            else{
                alert('no text!');
            }
        }

        function toggleChat(btn){
            var user_remote_id = btn.id.replace(/dialog_closebtn_/,"");
            chatroom_id = "#chatroom_"+user_remote_id;
            $(chatroom_id).remove();
            /*if($(chatroom_id).css("display")=="none") {
                $(chatroom_id).css("display","block");
                btn.innerHTML="hide";
                //alert(document.getElementById("chatroomButton").innerHTML);
            }else {
                $(chatroom_id).css("display","none");
                btn.innerHTML="show";
            }*/
        }
    </script>
</html>