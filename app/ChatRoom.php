<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    public $table = 'chat_room_table';
    public function items()
    {
        return $this->belongsTo('App\Item');
    }

}
