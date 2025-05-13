<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Plan;
use App\Models\Rent;
use App\Models\RentalModel;
use App\Models\User;

class LaptopRental extends Mailable
{
    use Queueable, SerializesModels;
    

    public $plan , $rent, $rentalModel, $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Plan $plan, Rent $rent, RentalModel $rentalModel, User $user)
    {
        $this->plan = $plan;
        $this->rent = $rent;
        $this->rentalModel = $rentalModel;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.laptop_rental', ['user' => $this->user, 'plan' => $this->plan , 'rent' => $this->rent , 'rentalModel' => $this->rentalModel]);
    }
}
