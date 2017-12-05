<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('title');
            // This is now handled by the authors -> book table relationship
            // $table->string('author')->nullable();
            $table->integer('published');
            $table->string('cover')->comment('URL to cover photo for the book');
            $table->string('purchase_link')->comment('Expects a url to where the book can be purchased');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
