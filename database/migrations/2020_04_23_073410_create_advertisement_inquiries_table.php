<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisementInquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisement_inquiries', function (Blueprint $table) {
			$table->increments('id');
            $table->unsignedInteger('ads_id')->index();
            $table->unsignedInteger('user_id')->index();
            $table->text('name');
            $table->text('email');
            $table->text('phone_no');
            $table->text('message');
            $table->timestamps();
            $table->foreign('ads_id')->references('id')->on('advertisements');
            $table->foreign('user_id')->references('id')->on('cms_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertisement_inquiries');
    }
}
