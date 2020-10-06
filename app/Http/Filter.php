<?php

namespace App\Http;

use Exception;
use Illuminate\Http\Request;

abstract class Filter
{
    protected $request;
    protected $builder;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply($builder)
    {
        $this->builder = $builder;
        foreach($this->request->all() as $field=>$value)
        {
            if(!is_array($value) && $field !=='page')
            {
                throw new Exception('Что-то пошло не так!');
            }

            if(method_exists($this, $field))
            {
                call_user_func_array([$this, $field], [$value]);
            }
        }
    }
}
