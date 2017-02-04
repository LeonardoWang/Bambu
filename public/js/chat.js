//var chatroomNum=0;
var chat_room_id = 0; //chat room id

window.onload = function() {
    var elements = document.querySelectorAll( '.demo-image' );
    if(elements)
        Intense( elements );

    var user_id = $("#user_id").val();

    //notif socket open when onload
    socket_notif = user_id+':App\\Events\\NotifEvent';
    socket.on(socket_notif, function(data){
        //console.log(data);
        console.log('listen to user_id= '+user_id+'\'s Notif ');
    });

    console.log(socket);
  }

function onSubmit(id){
    chat_room_id = id;
    var user_remote_id = $("#user_remote_id").val();
    var send_text = $("#dialog_sendtext_" + chat_room_id).val();
    if(send_text)
    {
        //front end display
        document.getElementById("dialog_userid_"+chat_room_id).innerHTML+=document.getElementById("userName").value+"<br>";
        document.getElementById("dialog_message_"+chat_room_id).innerHTML+=send_text + "<br>";
                
        if(chat_room_id==0 || '')
        {
          $.ajax({
                type:"get",
                url:'/api/chat/GetChatRoomIDByUserID',
                data:{'user_id':user_remote_id},
                
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
        }

        $.ajax({
                type:"get",
                url:'/api/chat?chat_room_id='+chat_room_id+'&chat_infomation='+send_text ,
                //data:{'chat_room_id':chat_room_id,'chat_infomation':send_text},
                
                success:function(data){
                    console.log(data);
                    document.getElementById("dialog_sendtext_"+chat_room_id).value = "";
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
    $(chatroom_name).remove();
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
    var user_remote_id = $("#user_remote_id").val();
        if(!document.getElementById("chatroom_"+chat_room_id))
        {
            $.ajax({
                type:"get",
                url:'/api/chat/GetChatMessageByUserId',
                data:{'user_id':user_remote_id},
                
                success:function(message) {
                    console.log(message);
                    chat_room_id = message.chat_room_id;

                    document.getElementById("chatroom").innerHTML+='<div id="chatroom_'+message.chat_room_id+'"><div class="thumbnail" style="height:200px; overflow-y:auto;"><button id="dialog_closebtn_'+message.chat_room_id+'" onclick="toggleChat(this)" class="btn btn-xs bambu-color1" style="position:absolute;top:0px;right:0px;z-index:1000">close</button><div class="col-md-3 caption" id="dialog_userid_'+message.chat_room_id+'"></div> <div class="col-md-9 caption" id="dialog_message_'+message.chat_room_id+'"></div></div> <textarea class="thumbnail form-control" id="dialog_sendtext_'+message.chat_room_id+'" placeholder="reply here" onkeydown="enterToSubmit(this,event)"></textarea>      <input id="'+message.chat_room_id+'" onclick="onSubmit('+message.chat_room_id+')" class="btn" value="send" /></div>';

                    socket_chatroom = chat_room_id+':App\\Events\\SomeEvent';
                    socket.on(socket_chatroom, function(data){
                        console.log('listen to chatroom '+chat_room_id);
                        if(data.message !== null || '')
                        {
                            document.getElementById("dialog_userid_"+data.user_id).innerHTML+=data.user_id + "<br>";
                            document.getElementById("dialog_message_"+data.user_id).innerHTML+=data.message + "<br>";
                        }
                    });
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(XMLHttpRequest);
                    //alert(XMLHttpRequest.status);
                    //alert(XMLHttpRequest.readyState);
                    console.log(textStatus); // paser error;
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