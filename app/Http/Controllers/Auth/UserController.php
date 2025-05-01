<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Services\CacheService;
use App\Services\CodeService;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\VarifyRequest;
use App\Services\TokenService;
use App\Trait\ResponseStorageTrait;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use ResponseStorageTrait;

    protected $userService, $verificationCode, $cacheService, $tokenService;

    public function __construct(UserService $userService, CodeService $verificationCode, CacheService $cacheService, TokenService $tokenService)
    {
        $this->userService = $userService;
        $this->verificationCode = $verificationCode;
        $this->cacheService = $cacheService;
        $this->tokenService = $tokenService;
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->userService->CreateUser($request);

        $generateCode =  $this->verificationCode->GenerationCode();

        $this->cacheService->StoreInCacheAndSendToEmail($generateCode, $user);

        return $this->SuccessResponse('Registration successful! Please check your email for the verification code.', 201);
    }


    public function varify(VarifyRequest $request)
    {

        $userId =  $this->verificationCode->GetCode($request);

        $this->userService->CheckUserId($userId);

        $this->userService->FindUserById($userId);

        $this->cacheService->Forget($request);

        return $this->SuccessResponse('Email Varified Successfully', 200);
    }

    public function resendCode(LoginRequest $request)
    {

        $user =  $this->userService->FindUser($request);

        $this->userService->CheckUserEmail($user);

        $verificationCode = $this->verificationCode->GenerationCode($user);


        $this->cacheService->StoreInCacheAndSendToEmail($verificationCode, $user);

        return $this->SuccessResponse('Your Code Resend', 200);
    }

    public function login(LoginRequest $request)
    {

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            $token = $user->createToken('MyApp')->plainTextToken;

            session(['access_token' => $token]);

            return response()->json([

                'access_token' => $token,
                
            ]);
        } else {

            return $this->ErrorResponse('User Not Found');
        }
    }

    public function refreshToken(LoginRequest $request)
    {

        session()->forget('access_token');
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            $newToken = $user->createToken('MyApp')->plainTextToken;

            session(['access_token' => $newToken]);

            return response()->json([

                'new_access_token' => $newToken,
            ]);

        } else {

            return $this->ErrorResponse('User Not Found');
        }
    }
}
