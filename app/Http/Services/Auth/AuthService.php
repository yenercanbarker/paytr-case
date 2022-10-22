<?php

namespace App\Http\Services\Auth;

use App\Http\Enumerations\RoleEnum;
use App\Http\Interfaces\RoleUser\RoleUserInterface;
use App\Http\Interfaces\User\UserInterface;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * User Repository Instance
     * @var UserInterface
     */
    private $userRepository;

    /**
     * Auth Service Constructor
     * @param UserInterface $_userRepository
     */
    public function __construct(UserInterface $_userRepository)
    {
        $this->userRepository = $_userRepository;
    }

    /**
     * Auth Service Login
     * @param $request
     * @return bool|string|null
     * @throws Exception
     */
    public function login($request): bool|string|null
    {
        $user = User::where([
            'email' => $request['email']
        ])
            ->firstOrFail();

        if ($user && Hash::check($request['password'], $user->password)) {
            $credentials = [
                'username' => $request['email'],
                'password' => $request['password'],
                'client_id' => config('app.passport_client_id'),
                'client_secret' => config('app.passport_client_secret'),
                'grant_type' => 'password',
            ];

            $request = app('request')->create('/oauth/token', 'POST', $credentials);
            $response = app('router')->prepareResponse($request, app()->handle($request));

            return json_decode($response->getContent(), true)['access_token'];
        }

        return null;
    }

    /**
     * Auth Service Register
     * @param $request
     * @return mixed
     * @throws BindingResolutionException
     */
    public function register($request): mixed
    {
        $request['password'] = Hash::make($request['password']);
        $user = $this->userRepository->store($request);

        if ($user) {
            app()->make(RoleUserInterface::class)
                ->store($user->id, RoleEnum::USER);
        }

        return $user;
    }

    /**
     * Auth Service Register Admin
     * @param $request
     * @return mixed
     * @throws BindingResolutionException
     */
    public function registerAdmin($request): mixed
    {
        $request['password'] = Hash::make($request['password']);
        $admin = $this->userRepository->store($request);

        if ($admin) {
            app()->make(RoleUserInterface::class)
                ->store($admin->id, RoleEnum::ADMIN);
        }

        return $admin;
    }

    /**
     * Auth Service Logout
     * @return bool
     */
    public function logout(): bool
    {
        if (Auth::check()) {
            $userTokens = auth()->user()->tokens;

            foreach($userTokens as $token) {
                $token->revoke();
            }
        }

        return true;
    }
}