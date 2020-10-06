<?php

namespace App\Http\Controllers\Admin;

use App\Genre;
use Illuminate\Http\Request;
use App\Http\Requests\GenreRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.genre.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.genre.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GenreRequest $request)
    {
        $genre = Genre::create($request->all());
        if(!(is_null($request->image)))
        {
            $path = $request->file('image')->store('/public/pictures');
            $genre->image = $path;
            $genre->save();
        }
        session()->flash('genre_result', 'Категория успешно добавлена!');
        return redirect('/admin/genres');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Genre $genre)
    {
        return $genre;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Genre $genre)
    {
        return view('admin.genre.edit', compact('genre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Genre $genre)
    {
        $request->validate([
            'code'=>'required|min:5',
            'name'=>'required|min:5',
            'description'=>'required|min:5',
        ]);
        $genre->update($request->all());
        if(!(is_null($request->image)))
        {
            Storage::delete($genre->image);
            $path = $request->file('image')->store('/public/pictures');
            $genre->image = $path;
            $genre->save();
        }
        session()->flash('genre_result', 'Категория успешно обновлена!');
        return redirect('/admin/genres');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();
        session()->flash('genre_result', 'Категория успешно удалена!');
        return redirect('/admin/genres');
    }
}
