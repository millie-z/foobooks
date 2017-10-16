<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;

class BookController extends Controller
{
    //

    public function index()
    {
        $jsonPath = database_path('books.json');
        $booksJson = file_get_contents($jsonPath); //holds data
        $books = json_decode($booksJson, true); //true makes it an array rather than an object
        return view('book.index')->with([
            'books' => $books
        ]);
    }

    public function show($title = null)
    {
        dump($title);
	    return view('book.show')->with([
            'title'=> $title,
        ]);
        //return 'Show the book '.$title;
    }

    /*public function example()
    {
        return Hash::make('topsecret');
    }*/

}
