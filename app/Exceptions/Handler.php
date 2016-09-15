<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
  /**
   * A list of the exception types that should not be reported.
   *
   * @var array
   */
  protected $dontReport = [
    HttpException::class,
  ];

  /**
   * Report or log an exception.
   *
   * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
   *
   * @param  \Exception $exception
   * @return void
   */
  public function report(Exception $exception)
  {


        parent::report($exception);
  }

  /**
   * Render an exception into an HTTP response.
   *
   * @param  \Illuminate\Http\Request $request
   * @param  \Exception               $exception
   * @return \Illuminate\Http\Response
   */
  public function render($request, Exception $exception)
  {
    return parent::render($request, $exception);
  }

    protected function convertExceptionToResponse(Exception $e)
    {
        if (config('app.debug')) {
            $whoops = new \Whoops\Run;
            if (request()->wantsJson()) {
                $whoops->pushHandler(new \Whoops\Handler\JsonResponseHandler());
            } else {
                $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
            }
            return response()->make(
                $whoops->handleException($e),
                method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500,
                method_exists($e, 'getHeaders') ? $e->getHeaders() : []
            );
        }
        return parent::convertExceptionToResponse($e);
    }




  /**
   * Render an exception using Whoops.
   *
   * @param  \Exception $e
   * @return \Illuminate\Http\Response
   */
  protected function renderExceptionWithWhoops(Exception $e)
  {
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());

    return new \Illuminate\Http\Response(
      $whoops->handleException($e),
      $e->getStatusCode(),
      $e->getHeaders()
    );
  }





    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Illuminate\Auth\AuthenticationException $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        return redirect()->guest('guestindex');
    }





}
