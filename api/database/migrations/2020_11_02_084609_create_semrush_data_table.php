<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSemrushDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semrush_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('platform_id');
            $table->double('rank')->nullable();
            $table->integer('keyword_num')->nullable();
            $table->integer('traffic')->nullable();
            $table->integer('traffic_costs')->nullable();
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
        Schema::table('semrush_data', function (Blueprint $table) {
            $table->dropForeign('semrush_data_platform_id_foreign');
        });
        Schema::dropIfExists('semrush_data');
    }
}
