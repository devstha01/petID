<?php

use App\Cloudsa9\Constants\AccountType;
use App\Cloudsa9\Constants\StatusType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('email_verified_notification_sent')->default(0);
            $table->string('password')->nullable();

            $table->string('phone')->nullable();
            // $table->string('pet_code')->unique();
            // $table->string('qr_code')->unique();

            $table->enum('account_type', AccountType::all())->default(AccountType::PAID);
            $table->enum('status', StatusType::all())->default(StatusType::ACTIVE);

            $table->rememberToken();

            $table->string('stripe_id')->nullable()->collation('utf8mb4_bin');
            $table->string('card_brand')->nullable();
            $table->string('card_last_four', 4)->nullable();
            $table->timestamp('trial_ends_at')->nullable();

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
        Schema::dropIfExists('users');
    }
}
