<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\Request;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        // Captura la excepción NotFoundHttpException cuando un ID no existe
        $this->renderable(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/tostados/*')) {
                return response()->json([
                    'status' => false,
                    'message' => 'The selected id is invalid'
                ], 404);
            }

            if ($request->is('api/bebidas/*')) {
                return response()->json([
                    'status' => false,
                    'message' => 'The selected bebidas is invalid'
                ], 404);
            }
        });
    }
}
