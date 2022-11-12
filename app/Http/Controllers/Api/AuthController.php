<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Exceptions\AuthException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @throws \App\Exceptions\AuthException
     */
    public function login(LoginRequest $request): array
    {
        $credentials = $request->validated();

        $token = Auth::attempt($credentials);

        if (!$token) throw new AuthException("E-mail e/ou senha inválido(s).", 400);

        return [
            "type"         => "Bearer",
            "expire_in"    => 3600,
            "access_token" => $token
        ];
    }
}
