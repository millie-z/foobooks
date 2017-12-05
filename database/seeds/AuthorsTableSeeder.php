<?php

use Illuminate\Database\Seeder;
use App\Author;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
         # Array of author data to add
         $authors = [
             ['F. Scott', 'Fitzgerald', 1896, 'https://en.wikipedia.org/wiki/F._Scott_Fitzgerald'],
             ['Sylvia', 'Plath', 1932, 'https://en.wikipedia.org/wiki/Sylvia_Plath'],
             ['Maya', 'Angelou', 1928, 'https://en.wikipedia.org/wiki/Maya_Angelou'],
             ['J.K.', 'Rowling', 1965, 'https://en.wikipedia.org/wiki/J._K._Rowling'],
             ['Dr.', 'Seuss', 1904, 'https://en.wikipedia.org/wiki/Dr._Seuss']
         ];
         $count = count($authors);

         # Loop through each author, adding them to the database
         foreach ($authors as $author) {
             Author::insert([
                 'created_at' => Carbon\Carbon::now()->subDays($count)->toDateTimeString(),
                 'updated_at' => Carbon\Carbon::now()->subDays($count)->toDateTimeString(),
                 'first_name' => $author[0],
                 'last_name' => $author[1],
                 'birth_year' => $author[2],
                 'bio_url' => $author[3],
             ]);
             $count--;
         }
     }
}
