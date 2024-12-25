<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // echo '<pre>';print_r($request->all());die;
        if (!auth()->guard('admin')->check()) { 
            return route('admin.login');
        }
        if (!auth()->guard('master')->check()) { 
            return route('master.login');
        }
         
        return $request->expectsJson() ? null : route('login');
    }
}
