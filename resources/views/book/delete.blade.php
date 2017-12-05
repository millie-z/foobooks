@extends('layouts.master')

@push('head')
    <link href='/css/book/delete.css' rel='stylesheet'>
@endpush

@section('title')
    Confirm deletion: {{ $book->title }}
@endsection

@section('content')
    <h1>Confirm deletion</h1>

    <p>Are you sure you want to delete <strong>{{ $book->title }}</strong>?</p>

    <img src='{{ $book['cover'] }}' class='cover' alt='Cover image for {{ $book['title'] }}'>

    <form method='POST' action='/book/{{ $book->id }}'>
        {{ method_field('delete') }}
        {{ csrf_field() }}
        <input type='submit' value='Yes, delete it!' class='btn btn-danger btn-small'>
    </form>

    <p class='cancel'>
        <a href='{{ $previousUrl }}'>No, I changed my mind.</a>
    </p>

@endsection
