<?php

namespace App\Http\Controllers\Auth;

use App\Http\Helpers\RedirectHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Services\Auth\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * Auth Service
     * @var AuthService
     */
    private $authService;

    /**
     * Auth Controller Constructor
     * @param AuthService $_authService
     */
    public function __construct(AuthService $_authService)
    {
        $this->authService = $_authService;
    }

    /**
     * Auth Controller Login
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $token = $this->authService->login($request->validated());

        if ($token) {
            return RedirectHelper::customSuccess([
                'token' => $token
            ]);
        }


        return RedirectHelper::error();
    }

    /**
     * Auth Controller Register
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = $this->authService->register($request->validated());
        if ($user) {
            return RedirectHelper::store([
                'user' => $user
            ]);
        }

        return RedirectHelper::error();
    }

    /**
     * Auth Controller Register Admin
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function registerAdmin(RegisterRequest $request): JsonResponse
    {
        $admin = $this->authService->registerAdmin($request->validated());
        if ($admin) {
            return RedirectHelper::store([
                'admin' => $admin
            ]);
        }

        return RedirectHelper::error();
    }

    /**
     * Auth Controller Logout
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        $this->authService->logout();

        return RedirectHelper::customSuccess();
    }
}