<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\VarifyRequest;
use App\Models\User;
use App\Services\CodeService;
use App\Services\LoginService;
use App\Services\UserService;
use App\Trait\ResponseStorageTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;


class TwoFactorAuthController extends Controller
{
    use ResponseStorageTrait;

    protected $loginService, $userService, $verificationCode;

    public function __construct(LoginService $loginService, UserService $userService, CodeService $verificationCode)
    {

        $this->loginService = $loginService;
        $this->userService = $userService;
        $this->verificationCode = $verificationCode;
    }

    public function TowFALogin(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');


        $this->loginService->CheckCredentials($credentials);

        $user =  $this->userService->FindUser($request);

        $this->verificationCode->GenerationCode($user);


        return $this->SuccessResponse('Check Your Email', 200);
    }


    public function Loginverify(VarifyRequest $request)
    {
        $userId = cache()->get($request->code);

        if (!$userId) {

            return $this->ErrorResponse('The Code is not Correct');
        }
        $user = User::find($userId);
        
        if (!$user) {
            return $this->ErrorResponse('User Not Found');
        }

        $user->email_verified_at = now();

        $user->save();

        cache()->forget($request->code);

        return $this->SuccessResponse('Email Varified Successfully Check Your Email', 200);
    }
}
