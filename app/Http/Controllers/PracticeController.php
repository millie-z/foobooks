<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Debugbar;
use cebe\markdown\MarkdownExtra;
use App\Book;
use App\Author;
use App\Utilities\Practice;

class PracticeController extends Controller
{
    /**
    * Retrieve many books with its tags; EAGER LOADING
    */
    public function practice26 ()
    {
        $books = Book::with('tags')->get();

        foreach ($books as $book)
        {
            dump($book->title.' is tagged with: ');
            foreach ($book->tags as $tag)
            {
                dump($tag->name.' ');
            }
        }
    }

    /**
    * Retrieve single book with its tags
    */
    public function practice25 ()
    {
        $book = Book::where('title', '=', 'The Great Gatsby')->first();

        dump($book->title.' is tagged with: ');
        foreach ($book->tags as $tag)
        {
            dump($tag->name);
        }
    }

    /**
    * Join related author data with the books query; EAGER LOADING
    */
    public function practice24 ()
    {
        # Eager load the author with the book
        $books = Book::with('author')->get();

        foreach ($books as $book) {
            dump($book->author->first_name.' '.$book->author->last_name.' wrote '.$book->title);
        }

        dump($books->toArray());
    }

    /**
    * Reads author information from first entry in query
    */
    public function practice23 ()
    {
        # Get the first book as an example
        $book = Book::first();

        # Get the author from this book using the "author" dynamic property
        # "author" corresponds to the the relationship method defined in the Book model
        $author = $book->author;

        # Output
        dump($book->title.' was written by '.$author->first_name.' '.$author->last_name);
        dump($book->toArray());
    }

    /**
    * Creates new book and associates with author
    */
    public function practice22 ()
    {
        $author = Author::where('first_name', '=', 'J.K.')->first();

        $book = new Book;
        $book->title = "Fantastic Beasts and Where to Find Them";
        $book->published = 2017;
        $book->cover = 'http://prodimage.images-bn.com/pimages/9781338132311_p0_v2_s192x300.jpg';
        $book->purchase_link = 'http://www.barnesandnoble.com/w/fantastic-beasts-and-where-to-find-them-j-k-rowling/1004478855';
        $book->author()->associate($author); # <--- Associate the author with this book
        $book->save();
        dump($book->toArray());
    }

    /**
    * Queries all books and orders by title
    */
    public function practice17 ()
    {
        $books = Book::orderBy('title')->get();

        return view('book.index')->with([
            'books' => $books
        ]);
    }


    /**
    * Remove any books by the author “J.K. Rowling”.
    */
    public function practice16 ()
    {
        // Custom method created specifically for the purposes of debugging
        Book::dump();

        $result = Book::where('author', '=', 'J.K. Rowling')->delete();

        dump('Deleted all books where author is like J.K. Rowling');

        Book::dump();

        Practice::resetDatabase();
    }

    /**
    * Find any books by the author Bell Hooks and update the author name to be bell hooks (lowercase).
    */
    public function practice15 ()
    {
        $book = Book::where('author', '=', 'Bell Hooks')->first();

        if (!$book)
        {
            dump("Book(s) not found, cannot update.");
        } else {
            // Change author properties
            $book->author = 'bell hooks';

            // Save changes
            $book->save();
            dump('Update complete. Check the database to confirm.');
        }
    }

    /**
    * Retrieve all the books in descending order according to published date.
    */
    public function practice14 ()
    {
        $results = Book::orderBy('published', 'desc')->get();
        dump($results->toArray());
    }

    /**
    * Retrieve all the books in alphabetical order by title.
    */
    public function practice13 ()
    {
        $results = Book::orderBy('title')->get();
        dump($results->toArray());
    }

    /**
    * Retrieve the last 2 books that were added to the books table.
    */
    public function practice12 ()
    {
        $results = Book::orderBy('created_at', 'desc')->limit(2)->get();
        dump($results->toArray());
    }

    /**
    *
    */
    public function practice11()
    {
        $book = Book::find(11);

        if(!$book)
        {
            dump('Did not delete book 11, did not find it.');
        } else {
            $book->delete();
            dump('Deleted book #11');
        }
    }
    /**
    *
    */
    public function practice10()
    {
        # First, get a book to update; a query to the database to get a book first
        $book = Book::where('author', 'LIKE', '%Scott%')->first();

        if (!$book) {
            dump("Book not found, can't update.");
        } else {
            # Change some properties
            $book->title = 'The Really Great Gatsby';
            $book->published = '2025';

            # Save the changes
            $book->save();

            dump('Update complete; check the database to confirm the update worked.');
        }
    }


    /**
    * Query all books published after 1950
    */
    public function practice9 ()
    {
        $results = Book::where('published', '>', 1950)->get();
        dump($results->toArray());
    }

    /**
    * Example of querying for books with constraints using an Eloquent model
    */
    public function practice8()
    {
        // Instantiate a new Book Model object
        $book = new Book();
        // Example of filtering; use get() for constraints
        $books = $book::where('title', 'LIKE', '%Harry Potter%')
            ->orWhere('published', '>=', 1800)
            ->orderBy('created_at', 'desc')
            ->get();

        dump($books->toArray());
    }

    /**
    * Example of querying for books using an Eloquent model
    */
    public function practice7()
    {
        // Instantiate a new Book Model object
        $book = new Book();

        $books = $book->all();

        dump($books->toArray());
    }

    /**
    * Example of adding a new book using an Eloquent model
    */
    public function practice6()
    {
        // Instantiate a new Book Model object
        $newBook = new Book();

        # Set the parameters
        # Note how each parameter corresponds to a field in the table
        $newBook->title = 'Harry Potter and the Sorcerer\'s Stone';
        $newBook->author = 'J.K. Rowling';
        $newBook->published = 1997;
        $newBook->cover = 'http://prodimage.images-bn.com/pimages/9780590353427_p0_v1_s484x700.jpg';
        $newBook->purchase_link = 'http://www.barnesandnoble.com/w/harry-potter-and-the-sorcerers-stone-j-k-rowling/1100036321?ean=9780590353427';

        $newBook->save();

        dump($newBook->toArray());
    }

    /**
    * Demonstration of a custom validation rule
    */
    public function practice5()
    {
        // use markdown extra
        $parser = new MarkdownExtra();
        echo $parser->parse('# Hello World');
    }


    /**
    * Example of using an external package
    */
    public function practice4()
    {
        Debugbar::info($_GET);
        Debugbar::info(['a' => 1, 'b' => 2, 'c' => 3]);
        Debugbar::error('Error!');
        Debugbar::warning('Watch out…');
        Debugbar::addMessage('Another message', 'mylabel');
        return 'Practice 4';
    }

    /**
    * Examples writing to the Debugbar
    */
    public function practice3()
    {
        return view('abc');
    }


    /**
    * Purposefully create and error to view it in the error logs
    */
    public function practice2()
    {
        $email = config('mail');
        dump($email);
    }

    /**
    * Viewing config info
    */
    public function practice1()
    {
        dump('This is the first example.');
    }


    /**
    * ANY (GET/POST/PUT/DELETE)
    * /practice/{n?}
    *
    * This method accepts all requests to /practice/ and
    * invokes the appropriate method.
    *
    * http://foobooks.loc/practice/1 => Invokes practice1
    * http://foobooks.loc/practice/5 => Invokes practice5
    * http://foobooks.loc/practice/999 => Practice route [practice999] not defined
    */
    public function index($n = null)
    {
        # If no specific practice is specified, show index of all available methods
        if (is_null($n)) {
            foreach (get_class_methods($this) as $method) {
                if (strstr($method, 'practice')) {
                    # Echo'ing display code from a controller is typically bad; making an
                    # exception here because:
                    # 1. This controller is for debugging/demonstration purposes only
                    # 2. This controller is introduced before we cover views
                    echo "<a href='".str_replace('practice', '/practice/', $method)."'>" . $method . "</a><br>";
                }
            }
        # Otherwise, load the requested method
        } else {
            $method = 'practice'.$n;

            if (method_exists($this, $method)) {
                return $this->$method();
            } else {
                dd("Practice route [{$n}] not defined");
            }
        }
    }
}
