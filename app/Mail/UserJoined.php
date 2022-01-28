<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Ride;

class UserJoined extends Mailable
{
    use Queueable, SerializesModels;

    public $ride;

    public function __construct(Ride $ride)
    {
        $this->ride = $ride; 
    }

    public function build()
    {
        $ride = Ride::with(['start_location'])->where('id', $ride->id)->get();   
        
        return $this->markdown('emails.ride.userjoined', $ride);
    }
}