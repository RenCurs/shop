<?php

namespace App;

use Exception;
use TypeError;
use App\Http\Filter;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['code', 'name', 'description', 'genre', 'publisher', 'published', 'price'];

    public function genres()
    {
        return $this->belongsToMany('App\Genre');
    }

    public function authors()
    {
        return $this->belongsToMany('App\Author');
    }

    public function getRouteKeyName()
    {
        return 'code';
    }

    public function scopeFilter($builder, Filter $filter)
    {
        try
        {
            $filter->apply($builder);
        }
        catch(TypeError $e)
        {
            abort(404, '123');
        }
    }

    public function scopePage(int $page)
    {
        $this->query->limit($page);
    }
}
