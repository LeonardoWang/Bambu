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
        <!--<script src='/js/intense.js'></script>-->
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

<!-- products on the home page -->
@if (isset($products) > 0)
    <div class="container">
        <div class="row" style="width:100%;margin:58px auto 60px auto; padding:auto;">
            <!--{{$i=0}}-->
            @for ($i = 0; $i < count($products);$i++)
            <!--foreach (products as product)-->
                @if ($i < 6)
                    <!--{{$product=$products[$i]}}-->
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="thumbnail">
                            <a href="/api/trade_requests/{{$product->id}}">
                            <img src="/api/product/images/{{$product->image_file}}" class="img-responsive" style="max-height:350px;">
                            </a>
                            <div class="caption" style="padding-top:0px;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div style="color:#9aa4af; overflow:hidden; height:35px;">
                                            <p style="margin:0 0 0 0px;">{{$product->description}}</p>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-8" style="text-align:left;padding-left: 0px;">
                                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style="padding-left:5px;">
                                            <img style="width:20px;" src="/img/icons/svg/clocks.svg"/>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                            <p style="color:#bdc3c7; font-size:15px; margin-top:2px;">{{substr($product->created_at,0,10)}}<p>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-4" style="text-align:left;">
                                            <p style="color:#f44336; margin-top:0px;">￥{{$product->price}}</p>
                                        </div>
                                        <!--<p>{{$product->image_file}}</p>-->
                                        <!--<p>created by <a href="#" class="bambu-color1">{{$product->user_name}}</a></p>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endfor
            <!--pagination not used in homepage
            <ul class="col-sm-3 col-md-3 col-lg-2 pagination">
            @for ($i = 1; $i < count($products)/3;$i++)
                <li id="{{$i}}" class="bambu-color1" onclick="turnpage({{$i}})"><a>{{$i}}</a></li>
            @endfor
            </ul>
            -->
        </div>

    <!--<footer class="footer navbar" id = "aboutUs" style="margin: 0px; padding: 0px; width:102.5%; left:-1.5%">
    @if (isset($user) > 0)
    <div id="chatroom" style="position:absolute;bottom:10px;background-color:transparent;display:none;">
        <div class="col-md-12 column">
            <div class="thumbnail" style="height:200px;">
                <div class="col-md-3 caption" id="dialog_userid"></div>
                <div class="col-md-9 caption" id="dialog_message"></div>
            </div>
            <form onsubmit="onSubmit(); return false;">
                <textarea class="form-control thumbnail" id="sendtext" placeholder="please reply here"></textarea>
                <div><input type="submit" class="btn" value="send" /></div>
            </form>
        </div>
    </div>
    <button id="chatroomButton" onclick="toggleChat()" class="btn btn-primary bambu-color1" style="position:absolute;bottom:10px; left:165px;">show</button>
    @endif
    <p style="text-align:center;font-size:11px;margin-bottom:0px;"> copyright@Onesia Group ltd. All Rights Reserved<br>京ICP备15050380-2<br>
        <a style="font-weight:inherit;color:inherit;background-color:inherit;" href="/">homepage</a> | <a style="font-weight:inherit;color:inherit;background-color:inherit;" href="mailto:brucewayne@pku.edu.cn">contact us</a></p>
    </footer>-->
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
@else
    <div class="container">
        <div class="row" style="margin-top:56px;">
            <h1>Sorry,no available items yet.</h1>
        </div>
    </div>

    <footer class="footer navbar-fixed-bottom" id = "aboutUs">
     <p style="text-align:center;font-size:11px;margin-bottom:0px;"> copyright@Onesia Group ltd. All Rights Reserved<br>京ICP备15050380-2<br>
        <a style="font-weight:inherit;color:inherit;background-color:inherit;" href="/">homepage</a> | <a style="font-weight:inherit;color:inherit;background-color:inherit;" href="mailto:brucewayne@pku.edu.cn">contact us</a></p>
</footer>
@endif

</body>
     <script type="text/javascript">
        window.onload = function() {
            //var elements = document.querySelectorAll( '.demo-image' );
            //Intense( elements );
            var socket = io('http://localhost:6001');
            socket.on('connection', function (data) {
                console.log(data);
            });
            socket.on('2:App\\Events\\SomeEvent', function(message){
                console.log(message);
            document.getElementById("dialog_userid").innerHTML+=message.user_id + "<br>";
            document.getElementById("dialog_message").innerHTML+=message.message + "<br>";
            });
            console.log(socket);

             $(".container").scroll(function(){  
         var $this =$(this),  
         viewH =$(this).height(),//可见高度  
         contentH =$(this).get(0).scrollHeight,//内容高度  
         scrollTop =$(this).scrollTop();//滚动高度  
        //if(contentH - viewH - scrollTop <= 100) { //到达底部100px时,加载新内容  
        if(scrollTop/(contentH -viewH)>=0.95){ //到达底部100px时,加载新内容  
        // 这里加载数据..  
        alert('666');
        }  
     });  
        }
    
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
                
                success:function(data){
                    //console.log(data);
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


                $.ajax({
                type:"post",
                url:'/api/chat',
                data:{'chat_room_id':chat_room_id,
                    'chat_infomation':send_text},
                
                success:function(data){
                    console.log(data);
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

        function createChatRoom(){
            var user_remote_id = $("#user_id").val();
            $.ajax({
                type:"get",
                url:'/api/chat/GetChatMessageByUserId',
                data:{'user_id':user_remote_id},
                
                success:function(message) {
                    console.log(message);
                    document.getElementById("chatroom").innerHTML+='<div id="chatroom_'+message.user_id+'" style="float:right">     <div class="thumbnail" style="height:200px;">     <button id="dialog_closebtn_'+message.user_id+'" onclick="toggleChat(this)" class="btn btn-xs bambu-color1" style="position:absolute;top:0px;right:0px;z-index:1000">close</button>                                                              <div class="col-md-3 caption" id="dialog_userid_'+message.user_id+'"></div>                                 <div class="col-md-9 caption" id="dialog_message_'+message.user_id+'"></div>                                </div>                                                                                                      <textarea class="thumbnail form-control" id="dialog_sendtext_'+message.user_id+'" placeholder="reply here"></textarea>                                                                                                  <div><input id="'+message.user_id+'" onclick="onSubmit(this)" class="btn" value="send" /></div></div>';
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
</html>
