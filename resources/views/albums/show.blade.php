@extends('layout')

@section('content')
    @if($errors->any())
        @foreach ($errors->all() as $error)
            <h3 style="margin-bottom: 10px; color: #C00;">{{ $error }}</h3>
        @endforeach
    @endif
    <div>
        Title: {{ $album->title  }} &nbsp; <a href="{{ route('album.index')  }}">Albums</a>
    </div>
    <div>
        List of images
    </div>
    @foreach($album->photos as $photo)
        <a target="_blank" href="{{ route('photos.show',$photo)  }}">
            <img style="margin: 5px;" width="120" src="{{ $photo->url  }}" alt="">
        </a>
    @endforeach
    <table>
        <tr>
            <td>
                <form action="{{ route('photos.store') }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="album_id" value="{{ $album->id }}">
                    <input style="width:100%;" placeholder="Image url" type="text" name="url" value="">
                    <input type="submit" name="Add" value="Add new image">
                </form>
            </td>
        </tr>
    </table>
@endsection