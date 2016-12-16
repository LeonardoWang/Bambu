<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    public $table = 'message_table';
    public function chat_room()
    {
        return $this->belongsTo('App\ChatRoom');
    }

}
