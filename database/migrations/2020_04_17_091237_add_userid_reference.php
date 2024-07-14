<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUseridReference extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_wishlist', function (Blueprint $table) {
           $table->unsignedInteger('user_id')->index();
           $table->foreign('user_id')->references('id')->on('cms_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_wiselist', function (Blueprint $table) {
            //
        });
    }
}
