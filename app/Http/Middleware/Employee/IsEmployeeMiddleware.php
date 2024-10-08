<?php

namespace App\Http\Middleware\Employee;

use Closure;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Enums\ResponseCodeEnums;
use Symfony\Component\HttpFoundation\Response;

class IsEmployeeMiddleware
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
        $user = User::find($request->user()->id)->employee->status;

        /*
        |--------------------------------------------------------------------------
        | custom middleware
        |--------------------------------------------------------------------------
        */
        if ($user !== "active") {
            return redirect()->intended(route('dashboard',parameters:["error"=>ResponseCodeEnums::INVALID_AUTHORIZATION->name], absolute: false));
        }

        return $next($request);
    }
}
