@extends('layouts.master')

@section('title')
    Show book
@endsection

@section('content')
    <h1>All Books</h1>

    @foreach($books as $title => $book)
        <div class='book'>
            <h2>{{ $title }}</h2>
            Authored by {{ $book['author'] }}
        </div>
    @endforeach
@endsection
