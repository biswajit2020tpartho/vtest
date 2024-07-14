<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('advertisements', function (Blueprint $table) {
            $table->unsignedInteger('cat_id')->after('status')->nullable()->->index();
            $table->decimal('amount', 8, 2)->default(0);
            $table->integer('seo_url_id')->after('status')->nullable()->index();
            $table->foreign('seo_url_id')->references('id')->on('seo_urls')->onDelete('cascade');
            $table->foreign('cat_id')->references('id')->on('categories');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('advertisement', function (Blueprint $table) {
            //
        });
    }
}
