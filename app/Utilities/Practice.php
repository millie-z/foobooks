<?php

namespace App\Utilities;

use Artisan;
use App\Book;

class Practice
{
    /*
    * Debugging/demo helper method to "blank state" the database
    * Used for practice queries
    */
    public static function resetDatabase()
    {
        dump('Clearing and re-seeding database');
        Artisan::call('migrate:fresh');
        Artisan::call('db:seed');
    }
}
