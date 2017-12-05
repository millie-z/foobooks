<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public function books()
    {
        # Author has many Books
        # Define a one-to-many relationship.
        return $this->hasMany('App\Book');
    }

    public static function getForDropdown()
    {
        $authors = Author::orderBy('last_name')->get();
        $authorsForDropdown = [0 => 'Choose one...'];
        foreach ($authors as $author)
        {
            $authorsForDropdown[$author->id] = $author->first_name.' '.$author->last_name;
        }

        return $authorsForDropdown;
    }
}
