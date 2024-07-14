<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index();
            $table->string('title',100);
            $table->string('images');
            $table->unsignedInteger('country_id')->index();
            $table->unsignedInteger('state_id')->index();
            $table->unsignedInteger('city_id')->index();
            $table->mediumText('short_description');
            $table->longText('description');
            $table->integer('view')->default(0);
            $table->boolean('status')->default(false);
            $table->boolean('approved')->default(false);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('cms_users');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('state_id')->references('id')->on('states');
            $table->foreign('city_id')->references('id')->on('citys');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertisements');
    }
}
