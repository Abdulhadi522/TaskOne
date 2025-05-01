<?php
namespace App\Services;  
use App\Http\Requests\VarifyRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class CacheService

{

    public function StoreInCacheAndSendToEmail($generateCode,$user){

        Cache::put([$generateCode => $user->id], now()->addMinutes(Config::get('cache.expiration_time')));

        $MailService  = new MailService();

        $MailService->SendToMail($generateCode,$user);
    }


    public function Forget(VarifyRequest $request){

        cache()->forget($request->code);

    }

}