<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TradeRequest extends Model
{
    protected $table = 'trade_requests';

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function item()
    {
        return $this->belongsTo('App\Item');
    }
}
