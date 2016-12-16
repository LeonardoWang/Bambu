<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    public $table = 'chat_room_table';
    public function items()
    {
        return $this->belongsTo('App\Item');
    }

}
