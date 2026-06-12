<?php

namespace App\Providers;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Str;

class AdminUserProvider extends EloquentUserProvider
{
    public function retrieveByCredentials(array $credentials): ?Authenticatable
    {
        $user = parent::retrieveByCredentials($credentials);

        if ($user && !$user->hasRole('admin')) {
            return null;
        }

        return $user;
    }

    public function retrieveById($identifier): ?Authenticatable
    {
        $user = parent::retrieveById($identifier);

        if ($user && !$user->hasRole('admin')) {
            return null;
        }

        return $user;
    }
}
