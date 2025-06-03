<?php

namespace App\Providers;

use App\Models\Koumnit;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

        // Role
        Gate::define('admin', function (User $user): bool {
            return (bool) $user->is_admin;
        });

        // Permission for Koumnit
        Gate::define('koumnit.delete', function (User $user, Koumnit $koumnit): bool {
            return ((bool) $user->is_admin || $user->id === $koumnit->user_id);
        });

        // Permission for User Profile
        Gate::define('profile.update', function (User $user, User $model): bool {
            return ((bool) $user->is_admin || $user->is($model));
        });
    }
}
