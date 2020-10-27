<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilterItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filter_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('filter_id');
            $table->string('name');
            $table->string('column_name')->nullable();
            $table->string('property');
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->string('value')->nullable();
            $table->json('items')->nullable();
            $table->timestamps();

            $table
                ->foreign('filter_id')
                ->references('id')
                ->on('filters')
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
        Schema::table('filter_items', function (Blueprint $table) {
            $table->dropForeign('filter_items_filter_id_foreign');
        });
        Schema::dropIfExists('filter_items');
    }
}
