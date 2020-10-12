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
            $table->integer('external_backlinks')->nullable();
            $table->integer('external_gov')->nullable();
            $table->integer('external_edu')->nullable();
            $table->integer('tf')->nullable();
            $table->integer('cf')->nullable();
            $table->integer('refd')->nullable();
            $table->integer('refd_edu')->nullable();
            $table->integer('refd_gov')->nullable();

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
