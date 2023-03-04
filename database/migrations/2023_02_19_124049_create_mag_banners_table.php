<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMagBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mag_banners', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('alt');
            $table->string('pic')->nullable();
            $table->string('code');
            $table->string('link');
            $table->string('landing_page');
            $table->tinyInteger('row');
            $table->tinyInteger('col');
            $table->integer('order');
            $table->integer('click')->nullable();
            $table->tinyInteger('status');
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
        Schema::dropIfExists('mag_banners');
    }
}
