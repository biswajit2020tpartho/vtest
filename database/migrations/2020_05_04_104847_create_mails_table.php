<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('to_email', 100);
            $table->string('form_email', 100);
            $table->string('email', 100);
            $table->string('subject', 255);
            $table->longText('message');
            $table->boolean('status')->default(false);
            $table->string('type')->default("Unread");
            $table->string('mail_type')->default("To");
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
        Schema::dropIfExists('mails');
    }
}
