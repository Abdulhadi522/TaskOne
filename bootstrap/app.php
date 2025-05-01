<?php

use App\Trait\ResponseStorageTrait;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {})
    ->withExceptions(function (Exceptions $exceptions) {

        // $exceptions->render(function (Throwable $e, $request) {

        //     $response = new class {
        //         use ResponseStorageTrait;
        //     };

        //     if ($e instanceof NotFoundHttpException) {
        //         return $response::Error('Resource Not Found', 404);
        //     }
        //     if ($e instanceof ModelNotFoundException) {
        //         return $response::Error('Model Not Found', 404);
        //     }
        //     if ($e instanceof AuthenticationException) {
        //         return $response::Error('Authentication Required', 401);
        //     }
        //     if ($e instanceof AuthorizationException) {
        //         return $response::Error('Access Denied', 403);
        //     }
        //     if ($e instanceof ValidationException) {
        //         return $response::Error('Validation Failed', 422);
        //     }
        //     if ($e instanceof MethodNotAllowedHttpException) {
        //         return $response::Error('Method Not Allowed', 405);
        //     }
        //     if ($e instanceof HttpException) {
        //         return $response::Error('HTTP Error', $e->getStatusCode());
        //     }
        //     if ($e instanceof QueryException) {
        //         return $response::Error('Database Query Error', 500);
        //     }
        //     if ($e instanceof Exception) {
        //         return $response::Error('Internal Server Error', 500);
        //     }
        // });
    })->create();
