<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /*
    * Dumpt the essential details of books to the page
    * Used when practicing queries and need to quickly see books in database
    * Can accept a collection of books, or if non is provided, will default to all books
    */
    public static function dump($books = null)
    {
        $data = [];

        if (is_null($books))
        {
            $books = self::all();
        }

        foreach ($books as $book)
        {
            $data[] = $book->title.' by '.$book->author;
        }

        dump($data);
    }
}
