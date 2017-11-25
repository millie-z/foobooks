<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\Book;

class BookController extends Controller
{
    public function index()
    {
        /*
        *  Old code
        $jsonPath = database_path('books.json');
        $booksJson = file_get_contents($jsonPath); //holds data
        $books = json_decode($booksJson, true); //true makes it an array rather than an object
        */

        // running a query to populate view (as opposed to using json file)
        $books = Book::orderBy('title')->get();

        // This is an entirely new and different query...
        //$newBooks = Book::orderByDesc('created_at')->limit(3)->get();

        // This is querying on an existing query... AKA a collection
        $newBooks = $books->sortByDesc('created_at')->take(3);

        return view('book.index')->with([
            'books' => $books,
            'newBooks' => $newBooks,
        ]);
    }

    /**
    * GET /book/{$id}
    */
    public function show($id)
    {
        $book = Book::find($id);

        if (!$book)
        {
            return redirect('/book')->with('alert', 'Book not found');
        }

	    return view('book.show')->with([
            'book' => $book
        ]);
        //return 'Show the book '.$title;
    }

    /*public function example()
    {
        return Hash::make('topsecret');
    }*/

    /**
    * GET
    * /search
    */
    public function search(Request $request) {

        # Start with an empty array of search results; books that
        # match our search query will get added to this array
        $searchResults = [];

        # Store the searchTerm in a variable for easy access
        # The second parameter (null) is what the variable
        # will be set to *if* searchTerm is not in the request.
        $searchTerm = $request->input('searchTerm', null);

        # Only try and search *if* there's a searchTerm
        if ($searchTerm) {
            # Open the books.json data file
            # database_path() is a Laravel helper to get the path to the database folder
            # See https://laravel.com/docs/helpers for other path related helpers
            $booksRawData = file_get_contents(database_path('/books.json'));

            # Decode the book JSON data into an array
            # Nothing fancy here; just a built in PHP method
            $books = json_decode($booksRawData, true);

            # Loop through all the book data, looking for matches
            # This code was taken from v0 of foobooks we built earlier in the semester
            foreach ($books as $title => $book) {
                # Case sensitive boolean check for a match
                if ($request->has('caseSensitive')) {
                    $match = $title == $searchTerm;
                # Case insensitive boolean check for a match
                } else {
                    $match = strtolower($title) == strtolower($searchTerm);
                }

                # If it was a match, add it to our results
                if ($match) {
                    $searchResults[$title] = $book;
                }
            }
        }
        # Return the view, with the searchTerm *and* searchResults (if any)
        return view('book.search')->with([
            'searchTerm' => $searchTerm,
            'caseSensitive' => $request->has('caseSensitive'),
            'searchResults' => $searchResults
        ]);
    }

    public function create()
    {
        return view('book.create')->with([
            'title' => session('title')
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:3',
            'author' => 'required',
            'published' => 'required|min:4|numeric',
            'purchase_link' => 'required|url',
            'cover' => 'required|url',
        ]);

        # Add new book to the database
        $book = new Book();
        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->published = $request->input('published');
        $book->purchase_link = $request->input('purchase_link');
        $book->cover = $request->input('cover');
        $book->save();

        return redirect('/book')->with('alert', 'Your book '.$request->input('title').' was added.');
        //return redirect('/book/create')->with([
        //    'title' => $title
        //]);
    }

    public function edit($id)
    {
        $book = Book::find($id);

        if(!$book)
        {
            return redirect('/book')->with('alert', 'Book not found');
        }

        return view('book.edit')->with(['book' => $book]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|min:3',
            'author' => 'required',
            'published' => 'required|min:4|numeric',
            'purchase_link' => 'required|url',
            'cover' => 'required|url',
        ]);

        $book = Book::find($id);

        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->published = $request->input('published');
        $book->cover = $request->input('cover');
        $book->purchase_link = $request->input('purchase_link');
        $book->save();

        return redirect('/book/'.$id.'/edit')->with('alert', 'Your changes were saved.');
    }
}
