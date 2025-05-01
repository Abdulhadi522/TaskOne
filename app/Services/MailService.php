<?php

namespace App\Services;

use App\Mail\VerificationCodeMail;
use App\Trait\ResponseStorageTrait;
use Illuminate\Support\Facades\Mail;

class MailService
{
    use ResponseStorageTrait;

    public function SendToMail($verificationCode, $user)
    {

        Mail::to($user->email)->send(new VerificationCodeMail($verificationCode));
    }
}
