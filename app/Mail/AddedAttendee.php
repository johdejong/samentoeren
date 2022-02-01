<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Ride;
use App\Models\User;

class AddedAttendee extends Mailable
{
    use Queueable, SerializesModels;

    public $ride, $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Ride $ride, User $user)
    {
        $this->ride = $ride;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.ride.addedattendee')
            ->subject('Nieuwe deelnemer');
    }
}
