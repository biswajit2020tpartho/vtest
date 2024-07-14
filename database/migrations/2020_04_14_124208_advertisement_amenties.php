<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdvertisementAmenties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisement_amenties', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ads_id')->index();
            $table->unsignedInteger('amenties_id')->index();
            $table->boolean('status')->default(false);
            $table->timestamps();
            $table->foreign('ads_id')->references('id')->on('advertisements')->onDelete('cascade');
            $table->foreign('amenties_id')->references('id')->on('amenties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertisement_amenties');
    }
}
