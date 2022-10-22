<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use League\OAuth2\Server\Exception\OAuthServerException;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param Request $request
     * @return void
     * @throws OAuthServerException
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            throw new OAuthServerException('Unauthenticated.', 401, 'authenticaion_fail', 401);
        }
    }
}
