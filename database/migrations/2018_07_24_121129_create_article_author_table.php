<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleAuthorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('article_author');

        Schema::create('article_author', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('article_id');
            $table->integer('author_id');
            $table->unique(['article_id', 'author_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_author');
    }
}
