<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index();
            $table->string('transactions_id', 100)->nullable();
            $table->string('payments_from', 100)->nullable();
            $table->string('bank_name', 100)->nullable();
            $table->string('branch_name', 100)->nullable();
            $table->string('description', 100)->nullable();
            $table->decimal('amount',18, 2);
            $table->timestamps();
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
        Schema::dropIfExists('payments');
    }
}
