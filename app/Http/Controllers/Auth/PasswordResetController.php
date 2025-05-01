<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\resetRequest;
use App\Http\Requests\sendResetLinkEmailRequest;
use App\Trait\ResponseStorageTrait;
use Illuminate\Support\Facades\Password;
use App\Services\PasswordService;

class PasswordResetController extends Controller
{

    use ResponseStorageTrait;
    protected $passwordService;

    public function __construct(PasswordService $passwordService)
    {

        $this->passwordService = $passwordService;
    }

    public function sendResetLinkEmail(sendResetLinkEmailRequest $request)
    {
        $response =  $this->passwordService->ResetLink($request);

        if ($response == Password::RESET_LINK_SENT) {

            return $this->SuccessResponse('Reset Link Sent');

        } else {
            return $this->ErrorResponse('The Response did not sent');
        }

    }

    public function reset(resetRequest $request)
    {

        $this->passwordService->ResetPassword($request);
        return $this->SuccessResponse('The new Passowrd is done');


    }
}
