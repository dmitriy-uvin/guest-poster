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
            $table->unsignedBigInteger('external_backlinks')->nullable();
            $table->unsignedBigInteger('external_gov')->nullable();
            $table->unsignedBigInteger('external_edu')->nullable();
            $table->unsignedBigInteger('tf')->nullable();
            $table->unsignedBigInteger('cf')->nullable();
            $table->unsignedBigInteger('refd')->nullable();
            $table->unsignedBigInteger('refd_edu')->nullable();
            $table->unsignedBigInteger('refd_gov')->nullable();

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
