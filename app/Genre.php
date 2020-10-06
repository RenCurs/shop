<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    /**
     * Get the route key for the model.
     *
     * @return string
     */

    protected $fillable = ['name', 'code', 'description'];

    public function getRouteKeyName()
    {
        return 'code';
    }

    /**
     * The products that belong to the genre.
     */
    public function products()
    {
        return $this->belongsToMany('App\Product');
    }
}
