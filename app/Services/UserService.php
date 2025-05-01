<?php

namespace App\Services;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Trait\ResponseStorageTrait;
use Illuminate\Support\Facades\Config;

class UserService
{
    use ResponseStorageTrait;

    public function CreateUser(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'email_verified_at' => now()->addMinutes(Config::get('expiration_time'))
        ]);

        return $user;
    }

    public function FindUser(LoginRequest $request)
    {

        $user = User::where('email', $request->email)->first();

        return $user;
    }

    public function CheckUserEmail($user)
    {
        if (!$user->email_verified_at) {
            $this->ErrorResponse('Email already verified or user not found', 400);
        }
    }

    public function CheckUserId($userId)
    {

        if (!$userId) {
            $this->ErrorResponse('Email already verified or user not found', 400);
        }
    }

    public function FindUserById($userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return null;
        }

        $user->email_verified_at = now()->addMinutes(10);

        $user->save();

        return $user;
    }
}
