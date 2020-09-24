<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAhrefsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ahrefs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('platform_id');
            $table->string('status');
            $table->float('rank')->nullable();
            $table->float('dr')->nullable();
            $table->integer('eb')->nullable();
            $table->integer('rd')->nullable();
            $table->integer('dofollow')->nullable();
            $table->integer('ips')->nullable();

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
        Schema::table('ahrefs', function (Blueprint $table) {
            $table->dropForeign('ahrefs_platform_id_foreign');
        });
        Schema::dropIfExists('ahrefs');
    }
}
