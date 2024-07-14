<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisementsImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements_image_table', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ads_id')->index();
            $table->string('image_name', 100);
            $table->boolean('status')->default(false);
            $table->timestamps();
            $table->foreign('ads_id')
                ->references('id')
                ->on('advertisements')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertisements_image_table');
    }
}
