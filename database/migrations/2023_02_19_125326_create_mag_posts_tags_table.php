<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMagPostsTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mag_posts_tags', function (Blueprint $table) {
            $table->foreignId('post_id')->references('id')->on('mag_posts');
            $table->foreignId('tag_id')->references('id')->on('mag_tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mag_posts_tags');
    }
}
