<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function show(Author $author)
    {
        return view('author.show', compact('author'));
    }
}
