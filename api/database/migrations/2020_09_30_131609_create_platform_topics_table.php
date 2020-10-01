<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlatformTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('platform_topic', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('platform_id');
            $table->unsignedBigInteger('topic_id');

            $table
                ->foreign('platform_id')
                ->references('id')
                ->on('platforms');

            $table
                ->foreign('topic_id')
                ->references('id')
                ->on('topics');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('platform_topic', function (Blueprint $table) {
            $table->dropForeign('platform_topic_topic_id_foreign');
        });
        Schema::table('platform_topic', function (Blueprint $table) {
            $table->dropForeign('platform_topic_platform_id_foreign');
        });
        Schema::dropIfExists('platform_topic');
    }
}
