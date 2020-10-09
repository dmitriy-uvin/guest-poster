<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSemrushTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semrush', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('platform_id');
            $table->float('rank');
            $table->integer('keyword_num');
            $table->integer('traffic_costs');

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
        Schema::table('semrush', function (Blueprint $table) {
            $table->dropForeign('semrush_platform_id_foreign');
        });
        Schema::dropIfExists('semrush');
    }
}
