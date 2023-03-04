<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMagCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mag_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('meta_title');
            $table->mediumText('meta_desc');
            $table->longText('description')->nullable();
            $table->bigInteger('parent_id')->nullable();
            $table->integer('order');
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('mag_categories');
    }
}
