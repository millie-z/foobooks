@extends('layouts.master')

@push('head')
    <link href='/css/book/index.css' rel='stylesheet'>
    <link href='/css/book/_book.css' rel='stylesheet'>
@endpush

@section('title')
    All Books
@endsection

@section('content')

    <h1>Books</h1>

    <aside id='newBooks'>
        <h2>Recently Added</h2>
        <ul>
            @foreach($newBooks as $book)
                <li><a href='/book/{{ kebab_case($book['id']) }}'>{{ $book['title'] }}</a></li>
            @endforeach
        </ul>
    </aside>

    @foreach($books as $book)
        <div class='book cf'>
            <img src='{{ $book['cover'] }}' class='cover' alt='Cover image for {{ $book['title']}}'>
            <h2>{{ $book['title'] }}</h2>
            <p>By {{ $book['author'] }}</p>
            <a href='/book/{{ $book['id'] }}'>View</a> |
            <a href='/book/{{ $book['id'] }}/edit'>Edit</a> |
            <a href='/book/{{ $book['id'] }}/delete'>Delete</a>
        </div>
    @endforeach

@endsection
