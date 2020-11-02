<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMajesticDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('majestic_data', function (Blueprint $table) {
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
            $table->timestamps();

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
        Schema::table('majestic_data', function (Blueprint $table) {
            $table->dropForeign('majestic_data_platform_id_foreign');
        });
        Schema::dropIfExists('majestic_data');
    }
}
