<?php
namespace App\Services;  
use App\Exceptions\CustomException;
use App\Trait\ResponseStorageTrait;
use Illuminate\Support\Facades\Auth;

class LoginService
{
    use ResponseStorageTrait;

    public function CheckCredentials($credentials){
        
        if (Auth::attempt($credentials)) {

            return $this->SuccessResponse('Login successful, please enter the verification code.');

        } else {
            
            throw new CustomException("Invalid credentials." , 400);
        }
    }
}