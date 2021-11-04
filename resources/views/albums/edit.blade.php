@extends('albums.layout')
@section('content')
</br>
<div class="formcontainer">
    <div class="row">
        <div class="col-lg-12 margin-tb">
                <h2>Edit chosen album.</h2>
        </div>
    </div>
    </br>
    @if($errors->any())
    <div class="alert alert-danger">
        <b>There were some issues with your input. Please try again.</b>
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('albums.update', $album->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group row">
                    <label for="AlbumTitle" class="col-sm-2 col-form-control">AlbumTitle</label>
                    <div class="col-sm-10">
                        <input type="text" name="AlbumTitle" id="AlbumTitle" class="col-form-control" value="{{ $album->AlbumTitle }}">
                    </div>
                </div>
                </br>
                <div class="form-group row">
                    <label for="AlbumCover" class="col-sm-2 col-form-control">AlbumCover</label>
                    <div class="col-sm-10">
                        <input type="file" name="AlbumCover" id="AlbumCover" class="col-form-control-file">
                    </div>
                </div>
                </br>
                <div class="form-group row">
                    <label for="Artist" class="col-sm-2 col-form-control">Artist</label>
                    <div class="col-sm-10">
                        <input type="text" name="Artist" id="Artist" class="col-form-control" value="{{ $album->Artist }}">
                    </div>
                </div>
                </br>
                <div class="form-group row">
                    <label for="Genre" class="col-sm-2 col-form-control">Genre</label>
                    <div class="col-sm-10">
                        <select name="Genre" id="Genre">
                            <option value="">Select Genre</option>
                            @if($genres)
                                @foreach($genres as $genre)
                                    @if($genre == $album->Genre)
                                        <option value="{{ $genre }}" selected>{{ $genre }}</option>
                                    @else
                                        <option value="{{ $genre }}">{{ $genre }}</option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                </br>
                </br>
                <div class="form-group row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <button type="submit" name="submit" id="submit" class="btn btn-primary" >Save Album</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
