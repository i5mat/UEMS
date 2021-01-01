<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage-users', function ($user){
            return $user->hasAnyRoles(['admin', 'organizer']);
        });

        Gate::define('edit-users', function ($user){
           return $user->hasAnyRoles(['admin', 'organizer']);
        });

        Gate::define('delete-users', function ($user){
            return $user->hasRole('admin');
        });

        Gate::define('auth-access-user', function ($user){
            return $user->hasAnyRoles(['admin', 'organizer', 'user', 'PESERTA']);
        });

        Gate::define('student_view', function ($user){
           return $user->hasAnyRoles(['user', 'PESERTA', 'AJK', 'SU', 'BENDAHARI', 'TIMBALAN PENGERUSI', 'PENGERUSI']);
        });

        Gate::define('organizer_view', function ($user){
           return $user->hasRole('organizer');
        });

        Gate::define('admin_view', function ($user){
            return $user->hasRole('admin');
        });

        Gate::define('admin_organizer_view', function ($user){
            return $user->hasAnyRoles(['admin', 'organizer']);
        });

        Gate::define('all_except_admin_view', function ($user){
            return $user->hasAnyRoles(['user', 'PESERTA', 'AJK', 'SU', 'BENDAHARI', 'TIMBALAN PENGERUSI', 'PENGERUSI', 'organizer']);
        });

        Gate::define('all_users', function ($user){
            return $user->hasAnyRoles(['admin', 'user', 'PESERTA', 'AJK', 'SU', 'BENDAHARI', 'TIMBALAN PENGERUSI', 'PENGERUSI', 'organizer']);
        });

        Gate::define('admin_user_view', function ($user){
            return $user->hasAnyRoles(['admin', 'user', 'PESERTA', 'AJK', 'SU', 'BENDAHARI', 'TIMBALAN PENGERUSI', 'PENGERUSI']);
        });
    }
}
