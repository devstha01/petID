<?php

use App\Cloudsa9\Constants\DeviceType;
use App\Cloudsa9\Constants\LockScreenColor;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLockscreensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lockscreens', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->enum('device', DeviceType::all())->default(DeviceType::PHONE);
            $table->enum('lockscreen_color', LockScreenColor::all())->default(LockScreenColor::BLACK);
            $table->string('lockscreen')->nullable();
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
        Schema::dropIfExists('lockscreens');
    }
}
