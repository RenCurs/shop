<?php

namespace App\Http\Controllers;

use App\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function show(Genre $genre)
    {
        return view('genre.show', compact('genre'));
    }
}
