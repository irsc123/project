<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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
       $this->reportable(function (\Throwable $e) {
    \Log::channel('assist')->error("⚠️ خطأ جديد تم تسجيله", [
        'message' => $e->getMessage(),
        'file'    => $e->getFile(),
        'line'    => $e->getLine(),
        'url'     => request()->fullUrl(),
        'method'  => request()->method(),
        'ip'      => request()->ip(),
        'user'    => auth()->check() ? auth()->user()->id : 'Guest',
    ]);
});



    }
}
