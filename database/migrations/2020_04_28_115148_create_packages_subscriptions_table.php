<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages_subscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('payment_id')->index();
            $table->unsignedInteger('package_id')->index();
            $table->unsignedInteger('user_id')->index();
            $table->date('start_at');
            $table->date('expires_at');            
            $table->text('status')->default('Inactive');
            $table->timestamps();
            $table->foreign('payment_id')->references('id')->on('payments');
            $table->foreign('package_id')->references('id')->on('packages');
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
        Schema::dropIfExists('packages_subscriptions');
    }
}
