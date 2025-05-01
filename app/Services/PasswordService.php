<?php
namespace App\Services;

use App\Http\Requests\resetRequest;
use App\Http\Requests\sendResetLinkEmailRequest;
use App\Trait\ResponseStorageTrait;
use Illuminate\Support\Facades\Password;

class PasswordService
{

    use ResponseStorageTrait;

    public function ResetLink(sendResetLinkEmailRequest $request)
    {
        $response = Password::sendResetLink($request->only('email'));
        return $response;
    }



    public function ResetPassword(resetRequest $request)
    {

        $response = Password::reset($request->only('email', 'password', 'password_confirmation', 'token'), function ($user, $password) {
            $user->password = bcrypt($password);
            $user->save();
        });
        return $response;
    }
}
