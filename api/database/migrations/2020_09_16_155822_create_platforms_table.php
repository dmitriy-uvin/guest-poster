<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlatformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('platforms', function (Blueprint $table) {
            $table->id();
            $table->string('website_url');
            $table->integer('dr');
            $table->integer('da');
            $table->integer('organic_traffic');
            $table->boolean('dofollow_active');
            $table->boolean('free_home_featured_active');
            $table->boolean('niche_edit_link_active');
            $table->double('article_writing_price');
            $table->double('niche_edit_link_price')->nullable();
            $table->string('contacts');
            $table->double('price');
            $table->string('email');
            $table->string('comment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('platforms');
    }
}
