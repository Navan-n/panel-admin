<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMagSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mag_sliders', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('alt');
            $table->string('pic')->nullable();
            $table->string('pic_mobile')->nullable();
            $table->string('category')->nullable();
            $table->string('link');
            $table->string('position');
            $table->bigInteger('CreatedBy');
            $table->bigInteger('EditedBy')->nullable();
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
        Schema::dropIfExists('mag_sliders');
    }
}
