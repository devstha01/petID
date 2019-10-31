<?php

namespace App\Mail\Subscriber;

use App\Cloudsa9\Entities\Models\User\Lockscreen;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendLockscreen extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Lockscreen
     */
    private $lockscreen;

    /**
     * Create a new message instance.
     *
     * @param Lockscreen $lockscreen
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
        return $this->subject("Lock screen preview")
            ->attach(storage_path('app/public/' . $this->lockscreen->lockscreen), [
                'as' => 'lock_screen.jpg',
                'mime' => 'image/jpeg',
            ])
            ->markdown('subscriber.emails.lockscreen');
    }
}
