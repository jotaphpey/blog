<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("slug");
            $table->string("title");
            $table->string("description")->nullable();
            $table->mediumText("body")->nullable();
            $table->text("tagList")->nullable();
            $table->boolean("favorited")->default(false);
            $table->integer("favoritesCount")->unsigned()->default(0);
            $table->integer("author_id")->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
