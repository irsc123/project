<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // لو المستخدم مو مسجل دخول
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // لو المستخدم مسجل لكن مو أدمن
        if (Auth::user()->role !== 'admin') {
            // ممكن ترجع رسالة أو تمنعه
            return redirect()->route('home')->with('error', 'ما عندك صلاحية الدخول للوحة التحكم.');
            // أو:
            // abort(403, 'غير مصرح لك');
        }

        return $next($request);
}
}
