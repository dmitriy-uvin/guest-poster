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
            $table->unsignedBigInteger('fb_comments')->nullable();
            $table->unsignedBigInteger('fb_reac')->nullable();
            $table->unsignedBigInteger('fb_shares')->nullable();

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
        Schema::table('facebook', function (Blueprint $table) {
            $table->dropForeign('facebook_platform_id_foreign');
        });
        Schema::dropIfExists('facebook');
    }
}
