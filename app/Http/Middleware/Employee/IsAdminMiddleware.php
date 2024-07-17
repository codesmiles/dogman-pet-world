<?php

namespace App\Http\Middleware\Employee;

use Closure;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Enums\ResponseCodeEnums;
use Symfony\Component\HttpFoundation\Response;

class IsAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /*
        |--------------------------------------------------------------------------
        | find user employee data
        |--------------------------------------------------------------------------
        */
        $user = User::find($request->user()->id)->employee;

        /*
        |--------------------------------------------------------------------------
        | custom middleware
        |--------------------------------------------------------------------------
        */
        if (!$user || !$user->is_admin) {
            return redirect()->intended(route('dashboard',parameters:["error"=>ResponseCodeEnums::INVALID_AUTHORIZATION->name], absolute: false));
        }

        return $next($request);
    }
}
