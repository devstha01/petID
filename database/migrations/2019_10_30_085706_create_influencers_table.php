<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfluencersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('influencers', function (Blueprint $table) {
            $table->increments('id');
//            $table->unsignedInteger('user_id');

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('birthday')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('facebook_followers')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('twitter_followers')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('instagram_followers')->nullable();
            $table->string('tiktok_url')->nullable();
            $table->string('tiktok_followers')->nullable();
            $table->string('website_url')->nullable();
            $table->string('website_visitors')->nullable();
            $table->string('city')->nullable();
            $table->string('street')->nullable();
            $table->string('zip_code')->nullable();
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
        Schema::dropIfExists('influencers');
    }
}
