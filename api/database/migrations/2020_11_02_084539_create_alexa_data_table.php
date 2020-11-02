<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlexaDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alexa_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('platform_id');
            $table->double('rank')->nullable();
            $table->string('country')->nullable();
            $table->integer('country_rank')->nullable();
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
        Schema::table('alexa_data', function (Blueprint $table) {
            $table->dropForeign('alexa_data_platform_id_foreign');
        });
        Schema::dropIfExists('alexa_data');
    }
}
