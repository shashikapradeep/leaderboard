<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

use Leaderboard\Exceptions\AlreadyExistException;
use Leaderboard\Exceptions\BaseException;
use Leaderboard\Exceptions\oAuthValidationException;
use Leaderboard\Traits\HttpResponse;


use Throwable;

class Handler extends ExceptionHandler
{
    use HttpResponse;

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

    public function render($request, Throwable $exception): JsonResponse
    {
        #sentry
        if (app()->bound('sentry') && $this->shouldReport($exception)) {
            app('sentry')->captureException($exception);
        }

        if ($request->wantsJson()) {

            //Unauthenticated
            if ($exception instanceof AuthenticationException || $exception instanceof oAuthValidationException) {
                return $this->sendErrorResponse(null, $exception->getMessage(), 401);
            }

            $code = $exception->getCode() ?: 500;

            if (config('app.debug')) {
                $response = $exception->getMessage();
                $debug = $exception->getTrace();
                $message = $exception->getMessage();

                if ($exception instanceof QueryException) {
                    $code = 500;
                }

                return $this->sendErrorResponse([],
                    $response,
                    $code,
                    null,
                    [],
                    $debug
                );
            } else {

                $message = "Something went wrong, Please try again later.";

                if ($exception instanceof BaseException) {
                    return $this->sendErrorResponse([], $exception->getMessage(), $exception->getCode());
                }

                if ($exception instanceof AlreadyExistException) { //AlreadyExist Exception
                    return $this->sendErrorResponse(['exist' => true], $exception->getMessage(), $exception->getCode() ?: 200);
                }

                if ($exception instanceof MethodNotAllowedHttpException) { // MethodNotAllowed Exception
                    return $this->sendErrorResponse([], $exception->getMessage(), $exception->getCode() ?: 400);
                }

                if ($exception instanceof QueryException) {
                    $code = 500;
                    $message = "Server Error! Please Try Again.";
                    return $this->sendErrorResponse([], $message, $code);
                }

                //default
                return $this->sendErrorResponse(null,
                    $message,
                    $code,
                    [],
                    (array)$exception->getMessage()
                );
            }
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return $this->sendErrorResponse([], 'Method not allowed', 405);
        }

        return parent::render($request, $exception);
    }

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
