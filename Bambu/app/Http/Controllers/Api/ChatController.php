<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Storage;
use App\ChatRoom;
use App\Message;

class ApiChatController extends Controller
{
    public function ChatRoomIndex(Request $request, $item_id)
    {
    	$user = Auth::user();
    	return ChatRoom::where('item_id',$item_id)->where('user_id',$user->id)->get();
    }
}
