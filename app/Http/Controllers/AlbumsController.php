<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class AlbumsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums = Album::latest()->paginate(10);
        return view('albums.index', compact('albums'))->with('i',(request()->input('page',1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genres=['Hip-Hop', 'Pop', 'Rock', 'Alternative', 'Metal', 'Folk', 'Country', 'Others'];
        return view('albums.create',compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'AlbumTitle' => 'required',
            'AlbumCover' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'Artist' => 'required'
        ]);
        $imageName='';
        if($request->AlbumCover){
            $imageName = time() . '.' .$request->AlbumCover->extension();
            $request->AlbumCover->move(public_path('uploads'), $imageName);
        }
        $data = new Album;
        $data->AlbumTitle = $request->AlbumTitle;
        $data->AlbumCover = $imageName;
        $data->Artist = $request->Artist;
        $data->Genre = $request->Genre;
        $data->save();
        return redirect()->route('albums.index')->with('success','The album has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        $genres=['Hip-Hop', 'Pop', 'Rock', 'Alternative', 'Metal', 'Folk', 'Country', 'Others'];
        return view('albums.edit', compact('album', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $album)
    {
        $request->validate([
            'AlbumTitle'=>'required',
            'Artist'=>'required',
            'Genre'=>'required',
        ]);
        $imageName='';
        if($request->AlbumCover){
            $imageName = time() . '.' .$request->AlbumCover->extension();
            $request->AlbumCover->move(public_path('uploads'), $imageName);
            $album->AlbumCover = $imageName;
        }
        $album->AlbumTitle = $request->AlbumTitle;
        $album->Artist = $request->Artist;
        $album->Genre = $request->Genre;
        $album->update();
        return redirect()->route('albums.index')->with('success','The album has been updated as requested.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $album=Album::findOrFail($id);
        $album->delete();
        return redirect()->route('albums.index')->with('success', 'The chosen album has been deleted successfully.');
    }
}
