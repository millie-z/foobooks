{{-- /resources/views/book/create.blade.php --}}
@extends('layouts.master')

@section('title')
    New book
@endsection

@section('content')
    <h1>Add a new book</h1>

    <form method='POST' action='/book'>

        {{ csrf_field() }}

        <div class='details'>* Required fields</div>

        <label for='title'>* Title</label>
        <input type='text' name='title' id='title' value='{{ old('title') }}'>
        @if($errors->get('title'))
            <ul>
                @foreach($errors->get('title') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <label for='author'>* Author</label>
        <input type='text' name='author' id='author' value='{{ old('author') }}'>
        @if($errors->get('author'))
            <ul>
                @foreach($errors->get('author') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <label for='publishedYear'>* Published Year</label>
        <input type='text' name='publishedYear' id='publishedYear' value='{{ old('publishedYear') }}'>
        @if($errors->get('publishedYear'))
            <ul>
                @foreach($errors->get('publishedYear') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <input type='submit' value='Add book' class='btn btn-primary btn-small'>
    </form>

    @if(isset($title))
        <div class='confirmation'>Your book {{ $title }} was added successfully.</div>
    @endif
@endsection
