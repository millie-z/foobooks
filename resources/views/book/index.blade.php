@extends('layouts.master')

@section('title')
    Show book
@endsection

@section('content')

    <div class='newBooks' style='background-color:yellow'>
        <h1>New books to the library!</h1>
        @foreach($newBooks as $book)
            <div class='book cf'>
                <img src='{{ $book['cover'] }}' class='cover' alt='Cover image for {{ $book['title']}}'>
                <h2>{{ $book['title'] }}</h2>
                <p>By {{ $book['author'] }}</p>
                <a href='/book/{{ kebab_case($book['title']) }}'>View</a>
            </div>
        @endforeach
    </div>


    <h1>All Books</h1>

    @foreach($books as $book)
        <div class='book cf'>
            <img src='{{ $book['cover'] }}' class='cover' alt='Cover image for {{ $book['title']}}'>
            <h2>{{ $book['title'] }}</h2>
            <p>By {{ $book['author'] }}</p>
            <a href='/book/{{ $book['id'] }}'>View</a> | 
            <a href='/book/{{ $book['id'] }}/edit'>Edit</a>
        </div>
    @endforeach
@endsection
