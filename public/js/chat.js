//var chatroomNum=0;
var chat_room_id = 0; //the chat room id 
window.onload = function() {
    var elements = document.querySelectorAll( '.demo-image' );
    if(elements)
        Intense( elements );
    var socket = io('http://localhost:6001');
    socket.on('connection', function (data) {
        console.log(data);
    });

socket.on('2:App\\Events\\SomeEvent', function(data){
    //console.log(data);
    if(!document.getElementById("chatroom_"+data.user_id))//create a chatroom
    {
        chatroomNum++;
        //console.log("chatroomnumber: " + chatroomNum);
        document.getElementById("chatroom").innerHTML+='<div id="chatroom_'+data.user_id+'" style="float:right">     <div class="thumbnail" style="height:200px;">     <button id="dialog_closebtn_'+data.user_id+'" onclick="toggleChat(this)" class="btn btn-xs bambu-color1" style="position:absolute;top:0px;right:0px;z-index:1000">close</button>                                                              <div class="col-md-3 caption" id="dialog_userid_'+data.user_id+'"></div>                                 <div class="col-md-9 caption" id="dialog_message_'+data.user_id+'"></div>                                </div>                                                                                                      <textarea class="thumbnail form-control" id="dialog_sendtext_'+data.user_id+'" placeholder="reply here"></textarea>                                                                                                  <div><input id="'+data.user_id+'" onclick="onSubmit(this)" class="btn" value="send" /></div></div>';
    }
    document.getElementById("dialog_userid_"+data.user_id).innerHTML+=data.user_id + "<br>";
                document.getElementById("dialog_message_"+data.user_id).innerHTML+=data.message + "<br>";
    });


/* chatroom
    socket.on('2:App\\Events\\SomeEvent', function(data){
    //console.log(data);
    if(!document.getElementById("chatroom_"+data.user_id))//create a chatroom
    {
        chatroomNum++;
        //console.log("chatroomnumber: " + chatroomNum);
        document.getElementById("chatroom").innerHTML+='<div id="chatroom_'+data.user_id+'" style="float:right">     <div class="thumbnail" style="height:200px;">     <button id="dialog_closebtn_'+data.user_id+'" onclick="toggleChat(this)" class="btn btn-xs bambu-color1" style="position:absolute;top:0px;right:0px;z-index:1000">close</button>                                                              <div class="col-md-3 caption" id="dialog_userid_'+data.user_id+'"></div>                                 <div class="col-md-9 caption" id="dialog_message_'+data.user_id+'"></div>                                </div>                                                                                                      <textarea class="thumbnail form-control" id="dialog_sendtext_'+data.user_id+'" placeholder="reply here"></textarea>                                                                                                  <div><input id="'+data.user_id+'" onclick="onSubmit(this)" class="btn" value="send" /></div></div>';
    }
    document.getElementById("dialog_userid_"+data.user_id).innerHTML+=data.user_id + "<br>";
                document.getElementById("dialog_message_"+data.user_id).innerHTML+=data.message + "<br>";
    });
*/

    console.log(socket);
  }

function onSubmit(btn){
    var user_remote_id = btn.id;
    var send_text = document.getElementById("dialog_sendtext_"+user_remote_id).value;
    if(send_text)
    {
        document.getElementById("dialog_userid_"+user_remote_id).innerHTML+=document.getElementById("userName").value+"<br>";
        document.getElementById("dialog_message_"+user_remote_id).innerHTML+=send_text + "<br>";
                
        if(chat_room_id==0)
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
        if(!document.getElementById("chatroom_"+chat_room_id))
        {
            $.ajax({
                type:"get",
                url:'/api/chat/GetChatMessageByUserId',
                data:{'user_id':user_remote_id},
                
                success:function(message) {
                    console.log(message);
                    chat_room_id = message.chat_room_id;
                    document.getElementById("chatroom").innerHTML+='<div id="chatroom_'+message.chat_room_id+'" style="float:right"><div class="thumbnail" style="height:200px;">     <button id="dialog_closebtn_'+message.chat_room_id+'" onclick="toggleChat(this)" class="btn btn-xs bambu-color1" style="position:absolute;top:0px;right:0px;z-index:1000">close</button>                          <div class="col-md-3 caption" id="dialog_userid_'+message.chat_room_id+'"></div>                                                 <div class="col-md-9 caption" id="dialog_message_'+message.chat_room_id+'"></div></div>                                          <textarea class="thumbnail form-control" id="dialog_sendtext_'+message.chat_room_id+'" placeholder="reply here"></textarea>      <div><input id="'+message.chat_room_id+'" onclick="onSubmit(this)" class="btn" value="send" /></div></div>';
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