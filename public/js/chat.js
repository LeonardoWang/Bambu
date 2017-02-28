var socket;
var local_user_profile;
var remote_user_profile;

window.onload = function() {
    //load pic zoom func
    var elements = document.querySelectorAll( '.demo-image' );
    if(elements && typeof(Intense)=="function")
        Intense( elements );
    //notif socket open when onload
    var user_id = $("#user_id").val();
    socket = io('http://thebambu.com:6001');
    socket.on('connection', function (data) {
      //console.log(data);
      });
    socket_notif = user_id+':App\\Events\\NotifEvent';
    socket.on(socket_notif, function(data){
        if(!document.getElementById("chatroom_"+data.user_id)){
            alert('You\'ve received a new message, check it in \'Chat Center!\'');
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
        document.getElementById("dialog_chatmessage_"+user_remote_id).innerHTML+="<div align='right'><div style='position:relative;width:auto; display:inline-block !important;height:35px;background:#A0D468;border-radius:5px;padding:0px 10px 0px 10px;'><p style='padding-top:5px;font-size:15px;color:black'>" + send_text + "</p><div style='position:absolute;top:5px;right:-16px;width:0;height:0;font-size:0;border:solid 8px;border-color:#f2f2f2 #f2f2f2 #f2f2f2 #A0D468  ;'></div></div><img style='width:36px;margin:5px 0px 0px 16px;' class='img-circle user_profile_"+user_id+" src="+local_user_profile+"'></div><br>";

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
        alert('No text!');
    }
}

function toggleChat(user_remote_id){
    var chatroom_name = "#chatroom_"+user_remote_id;
    $(chatroom_name).remove();

    //hide function
    /*if($(chatroom_id).css("display")=="none") {
        $(chatroom_id).css("display","block");
        btn.innerHTML="hide";
        //alert(document.getElementById("chatroomButton").innerHTML);
    }else {
        $(chatroom_id).css("display","none");
        btn.innerHTML="show";
    }*/
}

function closeChat(){
    $("#chatroom").empty();
}

function clearChatHistory(btn){
    var user_remote_id = btn.id.replace(/dialog_clearbtn_/,"");
    document.getElementById("dialog_chatmessage_"+user_remote_id).innerHTML='';
}

function createChatRoom(user_remote_id){
    var user_id = $("#user_id").val();
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

                    document.getElementById("chatroom_user").innerHTML='<div id="chatroom_'+user_remote_id+'" style="position:absolute;bottom:20px;width:595px;left:'+ (document.body.clientWidth-692) +'px"><div class="thumbnail" style="background:#DDDDDD;border:0px;margin-bottom:0px;height:344px; overflow-y:auto;"><p style="text-align:center;font-size:14px;padding-top:10px;margin-bottom:0px;">chat history with '+user_remote_name+'</p><button onclick="toggleChat('+user_remote_id+')" class="btn btn-xs bambu-color1" style="position:absolute;top:0px;right:0px;z-index:1000">CLOSE</button><button id="dialog_clearbtn_'+user_remote_id+'" onclick="clearChatHistory(this)" class="btn btn-xs bambu-color1" style="position:absolute;bottom:55px;right:0px;z-index:1000">CLEAR</button><div id="dialog_chatmessage_'+user_remote_id+'" style="text-align:left;"></div></div><textarea class="thumbnail form-control-1" id="dialog_sendtext_'+user_remote_id+'" placeholder="reply here" onkeydown="enterToSubmit(this,event)" style="width:595px;margin-bottom:11px;"></textarea>      <input id="'+user_remote_id+'" style="position:absolute;width:60px;bottom:12px;right:0px;z-index:1000" onclick="onSubmit('+user_remote_id+')" class="btn btn-xs" value="SEND" />';

                    //show the last 15 messages
                    for(i = data.message.length - 16; i < data.message.length; i++)
                    {
                        if(i>=0)
                        {
                            if(data.message[i].user_id==user_remote_id){
                            document.getElementById("dialog_chatmessage_"+user_remote_id).innerHTML+="<img style='width:36px;' class='img-circle user_profile_"+data.message[i].user_id+"'><div style='position:relative;width:auto; display:inline-block !important; display:inline; height:35px;background:white;border-radius:5px;margin:25px 0px 0px 15px;padding:0px 10px 0px 10px;'><div style='position:absolute;top:5px;left:-15px;width:0;height:0;font-size:0;border:solid 8px;border-color:#DDDDDD white #DDDDDD #DDDDDD;'></div><p style='padding-top:5px;font-size:15px;'>"+data.message[i].message + "</p></div><br>";
                            }
                            else{
                            document.getElementById("dialog_chatmessage_"+user_remote_id).innerHTML+="<div align='right'><div style='position:relative;width:auto; display:inline-block !important;margin-right:5px;height:35px;background:#A0D468;border-radius:5px;padding:0px 10px 0px 10px;'><p style='padding-top:5px;font-size:15px;color:black'>"+data.message[i].message + "</p><div style='position:absolute;top:5px;right:-16px;width:0;height:0;font-size:0;border:solid 8px;border-color:#DDDDDD #DDDDDD #DDDDDD #A0D468  ;'></div></div><img style='width:36px;margin:5px 0px 0px 16px;' class='img-circle user_profile_"+data.message[i].user_id+"'></div><br>";
                            }
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

        socket = io('http://thebambu.com:6001');
        //socket_chatroom1 = '1:App\\Events\\SomeEvent';
        socket_chatroom = chat_room_id + ':App\\Events\\SomeEvent';
        socket.on(socket_chatroom, function(dd){
            console.log('Received a new message from user: ' + dd.user_id);
            console.log(dd);
            if(dd.message !== null || '')
            {
                document.getElementById("dialog_chatmessage_"+dd.user_id).innerHTML+="<div style='background:white;position:relative;width:150px;height:35px;background:#F8C301;border-radius:5px;margin:30px auto 0;'><div style='position:absolute;top:5px;right:-16px;width:0;height:0;font-size:0;border:solid 8px;border-color:#f2f2f2 #f2f2f2 #f2f2f2 #F8C301;'><p>"+dd.message + "</p>" + "<img style='width:30px;' class='img-circle user_profile_"+dd.user_id+"'></div></div>";
            }
     });
    }

    $.ajax({
            type:"get",
            url:'/api/user/images/'+user_id,
            data:{},
            async:false,

            success:function(data){
                local_user_profile = data.image_path;
                $(".user_profile_"+user_id).attr("src",data.image_path);
            }
    });

    $.ajax({
            type:"get",
            url:'/api/user/images/'+user_remote_id,
            data:{},
            async:false,

            success:function(data){
                remote_user_profile = data.image_path;
                $(".user_profile_"+user_remote_id).attr("src",data.image_path);
            }
    });
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
            async:false,

            success:function(data) {
                //console.log(data.message);
                document.getElementById("chatroom").innerHTML+='<div id="chatroom_nav" style="z-index:-1;border:4px solid #7f8c8d;border-radius:10px;position:absolute;bottom:27px;left:'+ (document.body.clientWidth-792) +'px;width:700px;height:480px;background:#fff;"><h6 style="color:black;">Messages</h6><img src="/img/cross.png" onclick="closeChat()" style="cursor:pointer;position:absolute;top:0px;right:0px;z-index:1000"></div><div id="chatroom_left" style="background:#f2f2f2;width:95px;height:424px;border-radius:6px;position:absolute;bottom:32px;left:'+ (document.body.clientWidth-787) +'px"></div>';
                for(i = 0; i < data.chat_room_array.length; i++)
                {
                    var user_remote_id;
                    var user_remote_name;
                    if(data.chat_room_array[i].user_sell_id !== data.chat_room_array[i].user_buy_id) 
                    {    
                        if(data.chat_room_array[i].user_sell_id != user_id)
                        {
                            user_remote_id = data.chat_room_array[i].user_sell_id;                            
                        }
                        else if(data.chat_room_array[i].user_buy_id !== user_id)
                        {
                            user_remote_id = data.chat_room_array[i].user_buy_id;
                        }
                        
                        $.ajax({
                            type:"get",
                            url:'/api/user/images/'+user_remote_id,
                            data:{},
                            async:false,

                            success:function(data){
                                document.getElementById("chatroom_left").innerHTML+='<a onclick="createChatRoom('+user_remote_id+')"><img class="img-circle" style="width:40px;" src="' + data.image_path +'"></a><br>';
                            }
                        });
                    }
                }
                if(data.chat_room_array[0].user_sell_id !== data.chat_room_array[0].user_buy_id) 
                    if(data.chat_room_array[0].user_sell_id != user_id)
                        createChatRoom(data.chat_room_array[0].user_sell_id);
                    else if(data.chat_room_array[0].user_buy_id !== user_id)
                        createChatRoom(data.chat_room_array[0].user_buy_id);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest);
                //alert(XMLHttpRequest.status);
                //alert(XMLHttpRequest.readyState);
                console.log(textStatus); // paser error;
            }
        });
}