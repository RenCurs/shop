<?php

namespace App\Service;

use App\Genre;
use App\Author;
use App\Product;
use App\Http\Filter;
use Illuminate\Http\Request;

class ProductFilter extends Filter
{
    protected $product; 

    public function __construct(Product $product, Request $request)
    {
        parent::__construct($request);
        $this->product = $product;
    }

    public function authors(array $authors)
    {
        $id = [];

        foreach($authors as $authorId)
        {
            try
            {
                foreach(Author::find($authorId)->products as $product)
                {
                    $id[] = $product->id;
                }
            }
            catch(Exception $e)
            {
                $id = null;
            }
        }
        !(empty($id)) ? $this->builder->find($id) : $this->builder->find(null) ;
    }

    public function genres(array $genres)
    {
        $id = [];
        foreach($genres as $genreId)
        {
            try
            {
                foreach(Genre::find($genreId)->products as $product)
                {
                    $id[] = $product->id;
                }
            }
            catch(Exception $e)
            {
                $id = null;
            }
            
        }
        !(empty($id)) ? $this->builder->find($id) : $this->builder->find(null) ;
    }

    public function price(array $price)
    {
        $from = $price['from'];
        $to = $price['to'];

        if ( !is_null($from) && !is_null($to))
        {
            $this->builder->whereBetween('price', [$from, $to]);
        }
        elseif (!is_null($from))
        {
            $this->builder->where('price', '>=', $from);
        }
        elseif(!is_null($to))
        {
            $this->builder->where('price', '<=', $to);
        }
    }
}