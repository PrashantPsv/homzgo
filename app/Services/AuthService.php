<?php

namespace App\Services;

class AuthService
{
    public function token(): ?string
    {
        return session('catalog_auth_token');
    }

    public function check(): bool
    {
        return !empty($this->token());
    }

    public function user(): ?array
    {
        return session('catalog_user');
    }

    public function logout(): void
    {
        session()->forget([
            'catalog_auth_token',
            'catalog_user',
        ]);
    }
}