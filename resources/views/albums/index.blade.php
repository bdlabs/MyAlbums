@extends('layout')

@section('content')
    <table width="100%" border="0">
        <tr>
            <th style="text-align: left;">Title</th>
            <th width="100">Qty photos</th>
            <th width="100">Action</th>
        </tr>
        @foreach($albums as $album)
            <tr>
                <td>{{ $album->title }}</td>
                <td align="center">{{ $album->qty }}</td>
                <td align="center">
                    <a href="{{ route('album.show',$album) }}">View</a>
                    <form style="display: inline-block;" action="{{ route('album.destroy', $album) }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="submit" name="delete" value="delete"></input>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <a href="{{ route('album.create') }}">Add new album</a>
@endsection