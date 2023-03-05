<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->mediumText('icon')->nullable();
            $table->bigInteger('parent_id');
            $table->string('meta_title');
            $table->string('slug');
            $table->integer('order');
            $table->tinyInteger('new');
            $table->longText('description');
            $table->longText('meta_desc');
            $table->string('pic')->nullable();
            $table->string('alt');
            $table->string('pic_title');
            $table->integer('off');
            $table->bigInteger('createdBy');
            $table->bigInteger('editedBy')->nullable();
            $table->timestamp('start_time')->nullable();
            $table->timestamp('finish_time')->nullable();
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
        Schema::dropIfExists('categories');
    }
};
