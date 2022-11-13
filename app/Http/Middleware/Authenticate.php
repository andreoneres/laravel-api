<?php

namespace App\Http\Middleware;

use App\Exceptions\AuthException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Handle an unauthenticated user.
     *
     * @param \Illuminate\Http\Request $request
     * @param array $guards
     *
     * @return void
     *
     * @throws \App\Exceptions\AuthException
     */
    protected function unauthenticated($request, array $guards): void
    {
        throw new AuthException("User not unauthenticated", 401);
    }
}
