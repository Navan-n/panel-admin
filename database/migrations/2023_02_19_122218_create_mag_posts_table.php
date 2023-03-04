<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMagPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mag_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('meta_title');
            $table->text('meta_desc');
            $table->longText('abstracted');
            $table->longText('body');
            $table->integer('shop_category')->nullable();
            $table->string('slug')->unique();
            $table->bigInteger('auther')->default(0);
            $table->tinyInteger('published')->default(0);
            $table->timestamp('published_date')->nullable();
            $table->string('simulars')->nullable();
            $table->string('more')->nullable();
            $table->string('source');
            $table->string('source_link');
            $table->string('pic')->nullable();
            $table->string('pic_small')->nullable();
            $table->string('pic_verysmall')->nullable();
            $table->string('video')->nullable();
            $table->string('embed');
            $table->string('alt');
            $table->integer('view')->nullable();
            $table->integer('view_aff')->nullable();
            $table->tinyInteger('chief_select');
            $table->tinyInteger('type');
            $table->tinyInteger('share')->nullable();
            $table->string('products')->nullable();
            $table->bigInteger('createdBy')->nullable();
            $table->bigInteger('editedBy')->nullable();
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
        Schema::dropIfExists('mag_posts');
    }
}
