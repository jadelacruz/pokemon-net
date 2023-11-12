<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
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
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * @param  Request $request
     * @param  Throwable $e
     * @return RedirectResponse|Response
     * @throws Throwable
     */
    public function render($request, Throwable $e): RedirectResponse|Response
    {
        if ($request->is('api/*')) {
            $message = $e->getMessage();
            $code    = (is_string($e->getCode()) || $e->getCode() === 0)
                ? 500 : $e->getCode();

            return response()
                ->json([
                    'message' => $message,
                    'errors'  => $e->errors()
                ], $code);
        }

        return parent::render($request, $e);
    }
}
