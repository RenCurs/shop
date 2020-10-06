<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['name', 'phone', 'total_price'];

    public function products()
    {
        return $this->belongsToMany('App\Product')->withPivot('count', 'cost');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
