<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdvertisementReviews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisement_reviws', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ads_id')->index();
            $table->unsignedInteger('user_id')->index();
            $table->text('review_text');                        
            $table->integer('rating')->default(0);
            $table->boolean('status')->default(false);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('cms_users');
            $table->foreign('ads_id')->references('id')->on('advertisements')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertisement_reviws');
    }
}
