<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;

class BookController extends Controller
{
    //

    public function index()
    {
        return 'Show all the books...';
    }

    public function show($category, $title)
    {
        return 'You are viewing ' .$title .'under the cateogory ' .$category;
    }

    /*public function example()
    {
        return Hash::make('topsecret');
    }*/
    
}
