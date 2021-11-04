@extends('albums.layout')
@section('content')
@if($message=Session::get('success'))
    <div class="alert alert-success text-center">
        {{ $message }}
    </div>
@endif
    <table class="table">
    <thead>
        <tr>
        <th scope="col">AlbumCover</th>
        <th scope="col">AlbumTitle</th>
        <th scope="col">Artist</th>
        <th scope="col">Genre</th>
        <th scope="col"></th>
        </tr>
    </thead>
    @if($albums)
    <tbody>
        @foreach($albums as $album)
        <tr>
        <td class="align-middle"><img src="{{ asset('uploads/'.$album->AlbumCover) }}" class="img-thumbnail"/></td>
        <td class="align-middle">{{ $album->AlbumTitle }}</td>
        <td class="align-middle">{{ $album->Artist }}</td>
        <td class="align-middle">{{ $album->Genre }}</td>
        <td class="align-middle">
            <form action="{{ route('albums.destroy', $album->id) }}" method="post">    
            <a href="{{ route('albums.edit', $album->id) }}" class="btn btn-primary">Edit</a>
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Please confirm if you want to delete the chosen album.')">Delete</button>
            </form>
        </td>    
        </tr>
        @endforeach
    </tbody>
    @endif
    </table>
    <div class="d-flex">
        <div class="mx-auto">
            {!! $albums->links() !!}
        </div>
    </div>
@endsection