<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacebookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facebook', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('platform_id');
            $table->integer('fb_comments');
            $table->integer('fb_reac');
            $table->integer('fb_shares');

            $table
                ->foreign('platform_id')
                ->references('id')
                ->on('platforms')
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
        Schema::dropIfExists('facebook');
    }
}
