@extends('layout')

@section('content')

    @if($errors->any())
        @foreach ($errors->all() as $error)
            <h3 style="margin-bottom: 10px; color: #C00;">{{ $error }}</h3>
        @endforeach
    @endif

    <form action="{{ route('album.store') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input style="width:100%;" placeholder="Album title" type="text" name="title" value="">
        <input type="submit" name="Add" value="Add">
    </form>
@endsection