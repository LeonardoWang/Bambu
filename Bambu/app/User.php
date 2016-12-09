<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function items()
    {
        return $this->hasMany('App\Item');
    }

    public function sent_trade_requests()
    {
        return $this->hasMany('App\TradeRequest');
    }

    public function received_trade_requests()
    {
        return $this->hasManyThrough('App\TradeRequest', 'App\Item');
    }

    public function favorites()
    {
        return $this->belongsToMany('App\Item', 'favorites');
    }
}
