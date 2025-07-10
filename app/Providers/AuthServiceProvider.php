<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\ForumPost' => 'App\Policies\ForumPostPolicy',
        'App\Models\ForumComment' => 'App\Policies\ForumCommentPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('manage-schedules', function ($user) {
            return ($user->role === 'psychologist' && $user->is_verified) || $user->role === 'admin';
        });

        Gate::define('access-admin-dashboard', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('manage-patient-records', function ($user) {
            return ($user->role === 'psychologist' && $user->is_verified) || $user->role === 'admin';
        });
    }
}
