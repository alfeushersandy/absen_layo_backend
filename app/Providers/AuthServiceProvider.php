<?php

namespace App\Providers;

use App\Models\Absen;
use App\Models\Lembur;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('update-izin', function (User $user, Absen $absen) {
            return $user->id_kary === $absen->id_kary || $user->hasRole('super-admin');
        });

        Gate::define('delete-izin', function (User $user, Absen $absen) {
            return $user->id_kary === $absen->id_kary || $user->hasRole('super-admin|admin');
        });

        Gate::define('update-lembur', function (User $user, Lembur $lembur) {
            return $user->id_kary === $lembur->id_kary || $user->hasRole('super-admin');
        });

        Gate::define('delete-lembur', function (User $user, Lembur $lembur) {
            return $user->id_kary === $lembur->id_kary || $user->hasRole('super-admin|admin');
        });
    }
}
