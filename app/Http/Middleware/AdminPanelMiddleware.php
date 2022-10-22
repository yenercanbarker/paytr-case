<?php

namespace App\Http\Middleware;

use App\Http\Enumerations\RoleEnum;
use App\Http\Helpers\RedirectHelper;
use App\Http\Interfaces\RoleUser\RoleUserInterface;
use Closure;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AdminPanelMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     * @throws BindingResolutionException
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()) {
            $userRole = app()->make(RoleUserInterface::class)
            ->getUsersRoleByUserId(auth()->user()->id);

            if ($userRole && $userRole->role_id == RoleEnum::ADMIN) {
                return $next($request);
            }
        }

        return RedirectHelper::permissionDenied();
    }
}