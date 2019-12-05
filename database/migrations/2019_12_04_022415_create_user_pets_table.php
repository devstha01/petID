<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_pets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('pet_code')->unique();
            $table->string('qr_code')->unique();
            $table->string('name');
            $table->enum('gender',['Male','Female']);
            $table->string('color');
            $table->string('breed');
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->longText('message')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamp('status_verified_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::dropIfExists('user_pets');
    }
}
