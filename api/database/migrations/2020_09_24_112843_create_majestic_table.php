<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMajesticTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('majestic', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('platform_id');
            $table->integer('external_backlinks');
            $table->integer('external_gov');
            $table->integer('external_edu');
            $table->integer('tf');
            $table->integer('cf');

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
        Schema::table('majestic', function (Blueprint $table) {
            $table->dropForeign('majestic_platform_id_foreign');
        });
        Schema::dropIfExists('majestic');
    }
}
