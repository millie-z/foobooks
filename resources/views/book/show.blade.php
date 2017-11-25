@extends('layouts.master')


@section('title')
    {{ $book->title }}
@endsection

@section('content')
    <h1>{{ $book->title }}</h1>

    {{ $book->author }}
@endsection
