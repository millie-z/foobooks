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
        <input type='text' name='title' id='title' value='{{ old('title', 'Green Eggs & Ham') }}'>
        @include('modules.error-field', ['fieldName' => 'title'])

        <label for='author'>* Author</label>
        {{-- <input type='text' name='author' id='author' value='{{ old('author', 'Dr. Seuss') }}'> --}}

        @include('book.authorsDropdown')
        @include('modules.error-field', ['fieldName' => 'author'])

        <label for='published'>* Published Year (YYYY)</label>
        <input type='text' name='published' id='published' value='{{ old('published', '1960') }}'>
        @include('modules.error-field', ['fieldName' => 'published'])

        <label for='purchase_link'>* Purchase URL</label>
        <input type='text' name='purchase_link' id='purchase_link' value='{{ old('purchase_link', 'http://www.barnesandnoble.com/w/green-eggs-and-ham-dr-seuss/1100170349') }}'>
        @include('modules.error-field', ['fieldName' => 'purchase_link'])

        <label for='cover'>* Cover URL</label>
        <input type='text' name='cover' id='cover' value='{{ old('cover', 'http://prodimage.images-bn.com/pimages/9780394800165_p0_v4_s192x300.jpg') }}'>
        @include('modules.error-field', ['fieldName' => 'cover'])

        <input type='submit' value='Add book' class='btn btn-primary btn-small'>
    </form>

@endsection
