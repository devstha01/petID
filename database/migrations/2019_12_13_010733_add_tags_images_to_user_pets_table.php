<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTagsImagesToUserPetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_pets', function (Blueprint $table) {
            $table->string('front_tag')->nullable();
            $table->string('back_tag')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_pets', function (Blueprint $table) {
            $table->dropColumn('front_tag');
            $table->dropColumn('back_tag');
        });
    }
}
