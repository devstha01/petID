<?php

namespace App\Mail;

use App\Cloudsa9\Entities\Models\User\Lockscreen;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewUserPETiD extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Lockscreen
     */
    private $lockscreen;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Lockscreen $lockscreen)
    {
        $this->lockscreen = $lockscreen;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $newLockScreen = unserialize($this->lockscreen->lockscreen);
        $savepdf = storage_path('app/public/wallpaper/' . $newLockScreen['front']);
        $savepdf1 = storage_path('app/public/wallpaper/' . $newLockScreen['back']);
        $savepdf2 = storage_path('app/public/wallpaper/' . $newLockScreen['info']);

        return $this->subject("New PETiD User")
            ->attach($savepdf, [
                'as' => $newLockScreen['front'],
                'mime' => 'pdf',
            ])->attach($savepdf1, [
                'as' => $newLockScreen['back'],
                'mime' => 'pdf',
            ])->attach($savepdf2, [
                'as' => $newLockScreen['info'],
                'mime' => 'csv',
            ])
            ->markdown('subscriber.emails.newuser');
    }
}
