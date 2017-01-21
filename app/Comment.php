<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $table = 'comment_table';
    public function item()
    {
        return $this->belongsTo('App\Item');
    }

}
