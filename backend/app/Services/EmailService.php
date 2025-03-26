<?php

namespace App\Services;

use App\Mail;
use Illuminate\Support\Facades;

class EmailService
{
    public function sendMail(array $config)
    {
        //check storage/logs/laravel.log for the output
        Facades\Mail::to($config['sendTo'])->send(new Mail\CheckoutSuccessful($config));
    }
}
