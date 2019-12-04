<?php

namespace App\Console\Commands;

use App\Cloudsa9\Entities\Models\User\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Twilio;

class NotifyUnverifiedUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:unverified-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send SMS & email verification link to all users who have not verified the email within last 24 hours.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::whereNull('email_verified_at');
        $users = $users->where('email_verified_notification_sent', false);
        $users = $users->where('created_at', '<=', Carbon::now()->subDay())->get();

        foreach ($users as $user) {
            $user = User::find($user->id);

            try {
                // Resend email verification link
                $user->sendEmailVerificationNotification();
                // Send SMS
                if ($user->phone) {
                    $message = "Hello {$user->first_name}, Please remember to verify your email address for your Fownd account. We have sent another verification email to {$user->email}.";
                    Twilio::message($user->phone, $message);
                }
                // Update SMS sent status
                $user->email_verified_notification_sent = true;
                $user->save();
            } catch (Exception $e) {
                logger()->error($e);
            }
        }

        $this->info('SMS & email verify link sent to users.');
    }
}
