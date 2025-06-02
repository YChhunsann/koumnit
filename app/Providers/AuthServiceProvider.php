<?php

namespace App\Providers;

use App\Models\Koumnit;
use App\Models\User;
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

        // Permission
        Gate::define('koumnit.delete', function (User $user, Koumnit $koumnit): bool {
            return ((bool) $user->is_admin || $user->id === $koumnit->user_id);
        });

        Gate::define('koumnit.edit', function (User $user, Koumnit $koumnit): bool {
            return ((bool) $user->is_admin || $user->id === $koumnit->user_id);
        });
    }
}
