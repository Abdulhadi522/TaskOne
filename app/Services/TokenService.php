<?php

namespace App\Services;  

use Illuminate\Support\Facades\Request;

class TokenService
{
    public function DeleteToken(Request $request){

        return   $request->user()->tokens()->delete();

    }

    public function PlainText(Request $request){

        return $request->user()->createToken('new-token')->plainTextToken;

    }
}