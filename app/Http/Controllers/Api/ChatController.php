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

class ChatController extends Controller
{
    public function ChatRoomIndex(Request $request, $item_id)
    {
    	$user = Auth::user();
    	return ChatRoom::where('item_id',$item_id)->where('user_id',$user->id)->get();
    }

    public function MyChatroom()
    {
    	$user = Auth::user();
    	return ChatRoom::where('user_sell_id',$user->id)->orWhere('user_buy_id',$user->id)->get();
    }

    public function Chatroom()
    {
    	return view('chat');
    }

    public function Chat(Request $request)
    {
    	$this->validate($request, [
            'chat_room_id' => 'required',
            'chat_infomation'=> 'required'
        ]);
        $message = new Message();
        $message->chat_room_id = $request->input('chat_room_id');
        $message->user_id = Auth::user()->id;
        $message->information = $request->input('chat_information');

        Event::fire(new \App\Events\SomeEvent($message->chat_room_id,$message->user_id,$message->information));
        return 'success';
        
    }

    public function GetChatMessageByChatRoomID()
    {
    	$this->validate($request, [
            'chat_room_id' => 'required',
        ]);
        $chat_room_id = $request->input('chat_room_id');

        return Message::Where('chat_room_id',$chat_room_id)->get();
    }

    public function GetChatMessageByUserId()
    {
        $this->validate($request,[
            'user_id' => 'required']
            );
        $user_id = Auth::user()->id;
        $tmp_user_id = $request->input('user_id');

        $chat_room_id = ChatRoom::where('user_sell_id',$user_id)->Where('user_buy_id',$tmp_user_id)->get();
        if(empty($chat_room_id))
        {
            $chat_room_id = ChatRoom::where('user_sell_id',$tmp_user_id)->Where('user_buy_id',$user_id)->get();
            if(empty($chat_room_id))
            {
                $chatroom = new ChatRoom();
                $chatroom->user_sell_id = $user_id;
                $chatroom->user_buy_id = $tmp_user_id;
                $chatroom->save();
                $chat_room_id = $chatroom->id;
            }
        }
        return Message::Where('chat_room_id','$chat_room_id')->get();

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
