<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->integer('postcategory_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->string('title');
            $table->string('slug')->default("");
            $table->text('body');
            $table->string('book')->nullable();
            $table->boolean('archived')->default(0);

            //GOOGLE SEO
            $table->string('seo_description')->nullable();
            $table->string('seo_alternativeTitle')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->string('seo_url')->nullable();
            $table->integer('seo_wordCount')->default(0);

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
        Schema::dropIfExists('posts');
    }
}
