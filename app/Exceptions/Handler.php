<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

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
        $this->renderable(function (Throwable $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'status' => false,
                    'message' => $this->_getMessage($e)
                ], $this->_getHttpStatusCode($e));
            }
        });
    }

    private function _getMessage(Throwable $e): string
    {
        return !empty($e->getMessage()) ? $e->getMessage() : 'The requested URL was not found.';
    }

    /**
     * @param Throwable $e
     * @return int
     */
    private function _getHttpStatusCode(Throwable $e): int
    {
        $status = ResponseAlias::HTTP_INTERNAL_SERVER_ERROR;
        if ($e instanceof NotFoundHttpException) {
            $status = ResponseAlias::HTTP_NOT_FOUND;
        }
        if ($e instanceof ValidationException) {
            $status = ResponseAlias::HTTP_BAD_REQUEST;
        }
        return $status;
    }
}
