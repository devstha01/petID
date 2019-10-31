<?php

use App\Cloudsa9\Entities\Models\User\User;

/**
 * @return bool
 */
function isLoggedIn(): bool
{
    return auth()->guest() === false;
}

/**
 * @return User|\Illuminate\Contracts\Auth\Authenticatable
 */
function currentUser(): User
{
    return auth()->user();
}

/**
 * Dashboard URL for admin & subscriber
 *
 * @return string
 */
function dashboardUrl(): string
{
    $role = currentUser()->roles()->first()->name;

    if ($role == 'admin') {
        $dashboardUrl = route('admin.dashboard');
    } else {
        $dashboardUrl = route('subscriber.dashboard');
    }

    return $dashboardUrl;
}