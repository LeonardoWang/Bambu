<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    public $table = 'comment_table';
    public function item()
    {
        return $this->belongsTo('App\Item');
    }

}
