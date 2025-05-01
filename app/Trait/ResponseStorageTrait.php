<?php

namespace App\Trait;

trait ResponseStorageTrait
{
    public static function SuccessResponse($msg, $statusCode = 200){

        return response()->json(['message' => $msg] , $statusCode);
    }
    
    public function ErrorResponse($msg , $statusCode=400){
        
        return response()->json(['error' => $msg] , $statusCode);
    }


    public static function Error($msg ,$code){

        return $msg . $code;
    }


    public static function FilterByCategoryId($result){

        return response()->json($result);

    }
    public static function FilterByMostViews($result){

        return response()->json($result);

    }
    public static function FilterByTrending($result){

        return response()->json($result);

    }


    public static function Existlike($msg , $code){

        return response()->json(['message' => $msg], $code);  

    }


    public static function CreateLikeMessage($msg,$code){

        return response()->json(['message' => $msg], $code);  
    }

}
