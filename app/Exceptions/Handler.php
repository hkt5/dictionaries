<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function render($request, Exception $exception)
    {
        $fe = \Symfony\Component\Debug\Exception\FlattenException::create($exception);

        $statusCode = $fe->getStatusCode();
        $code       = $fe->getCode();
        $message    = $fe->getMessage();

        /**
         * This line of code resolves the issue
         *
         * To reproduce the issue :
         * 1) Comment this following line of code
         * 2) Provide a fake WSDL URL to the SoapClient
         *
         * Recommendation: Remove this line if you aren't using the SoapClient
         */
        error_clear_last();

        return new \Illuminate\Http\JsonResponse(
            ['content' => [], 'error_messages' => ['message' => $message, 'code' => $code]], $statusCode
        );
    }
}
