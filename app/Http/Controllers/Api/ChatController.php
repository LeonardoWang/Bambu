<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Storage;
use App\Item;
use App\ChatRoom;
use App\Message;
use Event;
use App\Notification;

class ChatController extends Controller
{
    public function ChatRoomIndex(Request $request, $item_id)
    {
    	$user = Auth::user();
    	return 0;
    }

    public function MyChatroom()
    {
    	$user = Auth::user();
        $chatroom = ChatRoom::where('user_sell_id',$user->id)->orWhere('user_buy_id',$user->id)->get();
        $notif = Notification::where('user_id',$user->id)->get();

    	return response()->json(array(
            'chat_room_array' => $chatroom,
            'notif' => $notif
        ));
    }

    public function MyNotif()
    {
        $user = Auth::user();
        $notif = Notification::where('user_id',$user->id)->get();
        return $notif;
           
    }
    public function GetChatRoomIDByUserID() //worked
    {
        $user = Auth::user();
        $user_id = $_GET['user_id'];
        $chat_room_id = ChatRoom::where('user_sell_id',$user->id)->Where('user_buy_id',$user_id)->first();
        if(empty($chat_room_id))
            $chat_room_id = ChatRoom::where('user_buy_id',$user->id)->Where('user_sell_id',$user_id)->first();

        return response()->json(array(
            'chat_room_id' => $chat_room_id->id
        ));
    }
    
    public function Chatroom()
    {
    	return view('chat');
    }

    public function Chat() //unworked
    {
        $message = new Message();
        $user = Auth::user();
        $message->chat_room_id = $_GET['chat_room_id'];
        $message->user_id = $user->id;
        $message->message = $_GET['chat_infomation'];

        Event::fire(new \App\Events\SomeEvent($message->user_id,$message->chat_room_id,$message->message));

        $room = ChatRoom::where('id',$message->chat_room_id)->first();

        if(empty($room))
            return response()->json(array(
            'status' => 'failed',
            'chat_room_id' => $message->chat_room_id
        ));
        $message->save();
        $notif = new NotifiController();
        if($room->user_sell_id == $message->user_id)
        {
            $notif->sendNotif($room->user_buy_id);
            $notif->addChatNotif($room->user_buy_id,$message->chat_room_id);
            $notif->removeChatNotif($message->user_id,$message->chat_room_id);
        }
        else
        {
            $notif->sendNotif($room->user_sell_id);
            $notif->addChatNotif($room->user_sell_id,$message->chat_room_id);
            $notif->removeChatNotif($message->user_id,$message->chat_room_id);
        }
        

        return response()->json(array(
            'status' => 'success',
            'user_id' => $message->user_id,
            'chat_room_id' => $message->chat_room_id
        ));
        
    }

    public function GetChatMessageByChatRoomID()
    {
        $chat_room_id = $_GET['chat_room_id'];
        $message = Message::Where('chat_room_id',$chat_room_id)->get();
        json_decode($message,true);
        return response()->json(array(
            'chat_room_id' => $chat_room_id,
            'message' => $message
        ));
    }

    public function GetChatMessageByUserId()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $tmp_user_id = $_GET['user_id'];

        $chat_room = ChatRoom::where('user_sell_id',$user_id)->Where('user_buy_id',$tmp_user_id)->first();
        if(empty($chat_room))
        {
            $chat_room = ChatRoom::where('user_sell_id',$tmp_user_id)->Where('user_buy_id',$user_id)->first();
            if(empty($chat_room))
            {
                $chatroom = new ChatRoom();
                $chatroom->user_sell_id = $user_id;
                $chatroom->user_buy_id = $tmp_user_id;
                $chatroom->save();
                $chat_room_id = $chatroom->id;
            }
            else{
                $chat_room_id = $chat_room->id;
            }
        }
        else{
            $chat_room_id = $chat_room->id;
        }
        
        $message = Message::Where('chat_room_id',$chat_room_id)->get();

        return response()->json(array(
            'chat_room_id' => $chat_room_id,
            'message' => $message
        ));

    }
    
    public function ChatMessageByItemID()
    {
    	$this->validate($request, [
            'item_id' => 'required',
        ]);
        $item_id = $request->input('item_id');
        $user_id = Auth::user()->id;
        $chat_infomation = $request->input('chat_infomation');
    	$user_sell_id = Item::Where('item_id','$item_id')->get()->pluck('user_id');    

    	if($user_sell_id != $user_id)
    	{
    		$user_buy_id = $user_id;
    		$chatroom = ChatRoom::Where('user_sell_id','$user_sell_id')->Where('user_buy_id','$user_buy_id')->get();
    		if(empty($chatroom))
    		{
    			$chatroom = new ChatRoom();
    			$chatroom->user_sell_id = $user_sell_id;
    			$chatroom->user_buy_id = $user_buy_id;
    			$chatroom->item_id =  $item_id;
    			$chatroom->save();
    			return "view chat room";
    		}
    		$chat_room_id = $chatroom->id;
    		return Message::Where('chat_room_id',$chat_room_id)->get();
    	}
    	else
    	{
    		return 'error';
    	}  
    }


}
