<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TriviaController extends Controller
{
    public function index()
    {
        return view('trivia.index');
    }

    public function checkAnswer()
    {
        return 'At this step we will check the answer...';
        # Redirect back to the page eventually...
    }
}
