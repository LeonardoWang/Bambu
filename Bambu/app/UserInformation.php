<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    public $table = 'user_information';
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
