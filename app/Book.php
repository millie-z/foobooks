<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function author()
    {
        # Book belongs to Author
        # Define an inverse one-to-many relationship.
        return $this->belongsTo('App\Author');
    }

    public function tags()
    {
        # With timetsamps() will ensure the pivot table has its created_at/updated_at fields automatically maintained
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

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
