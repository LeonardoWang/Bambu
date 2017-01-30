<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Events;
use DB;
use Storage;
use Crypt;
use App\Notification;
use Event;

class NotifiController extends Controller
{
    public function sendNotif($user_id)
    {
    	Event::fire(new \App\Events\NotifEvent($user_id));
    }

    public function addCommentNotif($user_id)
    {
    	$notif = Notification::where('user_id',$user_id)->where('is_comment',true)->get();
    	if(empty($notif))
    	{
    		$notif = new Notification;
    		$notif->user_id = $user_id;
    		$notif->is_comment = true;
    		$notif->save();
    	}
    }

    public function removeCommentNotif($user_id)
    {
    	$notif = Notification::where('user_id',$user_id)->where('is_comment',true)->get();
    	if(!empty($notif))
    	{
    		$notif->delete();
    	}
    } 

    public function addChatNotif($user_id,$chat_room_id)
    {
    	$notif = Notification::where('user_id',$user_id)->where('chat_room_id',$chat_room_id)->get();
    	if(empty($notif))
    	{
    		$notif = new Notification;
    		$notif->user_id = $user_id;
    		$notif->is_comment = false;
    		$notif->chat_room_id = $chat_room_id;
    		$notif->save();
    	}
    }

    public function removeChatNotif($user_id,$chat_room_id)
    {
    	$notif = Notification::where('user_id',$user_id)->where('chat_room_id',$chat_room_id)->get();
    	if(!empty($notif))
    	{
    		$notif->delete();
    	}
    }

    public function isNotif($user_id)
    {
    	$notif = Notification::where('user_id',$user_id)->get();
    	if(empty($notif))
    	{
    		return true;
    	}
    	else
    		return false;
    }

    public function NotifIndex($user_id)
    {
    	$notif = Notification::where('user_id',$user_id)->where('is_comment',false)->get();
    	return $notif;
    }
}
