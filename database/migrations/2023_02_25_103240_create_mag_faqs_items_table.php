<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMagFaqsItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mag_faqs_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('faq_id')->references('id')->on('mag_faqs');
            $table->string('title');
            $table->longText('answer');
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
        Schema::dropIfExists('mag_faqs_items');
    }
}
