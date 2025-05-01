<?php
// routes/api.php  

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\TwoFactorAuthController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Media\CommentController;
use App\Http\Controllers\Media\FilterController;
use App\Http\Controllers\Media\MediaController;
use App\Http\Controllers\Media\PoadcastController;
use App\Http\Controllers\Media\LikeController;


Route::post('/register',      [UserController         ::class , 'register']);
Route::post('/varify',        [UserController         ::class, 'varify']);
Route::post('/resend-code',   [UserController         ::class, 'resendCode']);
Route::post('/login',         [UserController         ::class, 'login']);
Route::post('password/email', [PasswordResetController::class, 'sendResetLinkEmail']);
Route::post('password/reset', [PasswordResetController::class, 'reset']);
Route::post('/refresh-token', [UserController         ::class, 'refreshToken']);
Route::post('send-code',      [TwoFactorAuthController::class, 'TowFALogin']);
Route::post('verify-code',    [TwoFactorAuthController::class, 'Loginverify']);
Route::post('/media',         [MediaController        ::class, 'StoreImage']);  
Route::middleware('auth:sanctum')->post('/poadcasts/upload' ,[PoadcastController::class , 'upload']);
Route::middleware('auth:sanctum')-> post('/poadcasts/{poadcast}/comments', [CommentController::class, 'store']); 
Route::middleware('auth:sanctum')-> post('/poadcasts/{poadcast}/like', [LikeController::class, 'like']); 
Route::middleware('auth:sanctum')-> post('/poadcasts/{poadcast}/unlike', [LikeController::class, 'unlike']); 

Route::get('/GetAllComments' , [CommentController::class , 'GetAllCommentsWithReplies']);
Route::get('/GetRandompoadcasts' , [PoadcastController::class , 'index']);
Route::get('/Filterpoadcasts' , [FilterController::class , 'Filter']);