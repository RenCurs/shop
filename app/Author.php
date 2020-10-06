<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = ['code', 'name', 'description'];

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }

    public function getRouteKeyName()
    {
        return 'code';
    }
}
