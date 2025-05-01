<?php


namespace app\Services;

use App\Http\Requests\VarifyRequest;

use Illuminate\Support\Str;

class CodeService
{


    public function GenerationCode()
    {

        $verificationCode = Str::random(30);

        return $verificationCode;



    }

    public function GetCode(VarifyRequest $request){

        $code = cache()->get($request->code);
        return $code;

    }

}
