@extends('layouts.master')

@section('title')
    Edit book {{ $book->title }}
@endsection

@section('content')
    <h1>Edit book {{ $book->title }}</h1>

    <form method='POST' action='/book/{{ $book->id }}'>

        {{ method_field('put') }}
        {{ csrf_field() }}

        <div class='details'>* Required fields</div>

        <label for='title'>* Title</label>
        <input type='text' name='title' id='title' value='{{ old('title', $book->title) }}'>
        @include('modules.error-field', ['fieldName' => 'author'])

        <label for='author'>* Author</label>
        @include('book.authorsDropdown')
        @include('modules.error-field', ['fieldName' => 'author'])

        <label for='published'>* Published Year (YYYY)</label>
        <input type='text' name='published' id='published' value='{{ old('published', $book->published) }}'>
        @include('modules.error-field', ['fieldName' => 'published'])

        <label for='purchase_link'>* Purchase URL</label>
        <input type='text' name='purchase_link' id='purchase_link' value='{{ old('purchase_link', $book->purchase_link) }}'>
        @include('modules.error-field', ['fieldName' => 'purchase_link'])

        <label for='cover'>* Cover URL</label>
        <input type='text' name='cover' id='cover' value='{{ old('cover', $book->cover) }}'>
        @include('modules.error-field', ['fieldName' => 'cover'])

        @foreach ($tagsForCheckboxes as $id => $name)
            <input
                type='checkbox'
                value='{{ $id }}'
                name='tags[]'
                {{ (isset($tagsForThisBook) and in_array($name, $tagsForThisBook)) ? 'CHECKED' : '' }}
            >
            {{ $name }} <br>
        @endforeach

        <input type='submit' value='Save changes' class='btn btn-primary btn-small'>
    </form>

@endsection
