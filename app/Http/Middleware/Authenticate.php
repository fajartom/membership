<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Crypt;
use Route;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if ($request->expectsJson())
            return;
        
        if (! Route::has('login.validate'))
            return route('login');

        return route('login', [
            'e' => Crypt::encrypt([
                'v' => route('login.validate', null),
                'r' => $request->fullUrl(),
            ]),
        ]);
    }
}
