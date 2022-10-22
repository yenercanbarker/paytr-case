<?php

namespace App\Exceptions;

use App\Http\Helpers\RedirectHelper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use League\OAuth2\Server\Exception\OAuthServerException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {

        });
    }

    public function render($request, $e)
    {
        if ($e instanceof ModelNotFoundException) {
            return RedirectHelper::error([
                'error' => [
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine()
                ]
            ]);
        }
        
        if ($e instanceof ValidationException) {
            return RedirectHelper::error([
                'error' => [
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine()
                ]
            ], 'Error', 422);
        }

        if ($e instanceof NotFoundHttpException) {
            return RedirectHelper::error([
                'error' => [
                    'message' => 'Route not found'
                ]
            ], '404 Not Found!', 404);
        }

        if ($e instanceof MethodNotAllowedHttpException) {
            return RedirectHelper::error([
                'error' => [
                    'message' => 'Request method not allowed'
                ]
            ], '405 Method Not allowed!', 405);
        }

        if ($e instanceof OAuthServerException) {
            return RedirectHelper::error([
                'error' => [
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine()
                ]
            ], 'Unauthenticated', 401);
        }

        return parent::render($request, $e);
    }
}