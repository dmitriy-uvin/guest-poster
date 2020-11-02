<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAhrefsDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ahrefs_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('platform_id');
            $table->double('rank')->nullable();
            $table->double('dr')->nullable();
            $table->integer('ext_backlinks')->nullable();
            $table->integer('refd')->nullable();
            $table->integer('dofollow')->nullable();
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
        Schema::table('ahrefs_data', function (Blueprint $table) {
            $table->dropForeign('ahrefs_data_platform_id_foreign');
        });
        Schema::dropIfExists('ahrefs_data');
    }
}
