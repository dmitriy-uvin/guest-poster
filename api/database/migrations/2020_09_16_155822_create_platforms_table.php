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
            $table->integer('organic_traffic')->nullable();
            $table->boolean('dofollow_active');
            $table->boolean('free_home_featured_active');
            $table->boolean('niche_edit_link_active');
            $table->double('niche_edit_link_price')->nullable();
            $table->double('article_writing_price');
            $table->string('article_requirements');
            $table->integer('deadline');
            $table->string('domain_zone');
            $table->double('price');
            $table->string('email');
            $table->string('description');
            $table->string('where_posted');
            $table->string('contacts')->nullable();
            $table->string('comment')->nullable();
            $table->integer('trust')->nullable();
            $table->double('spam')->nullable();
            $table->integer('lrt_power_trust')->nullable();
            $table->boolean('in_bucket')->default(false);
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
