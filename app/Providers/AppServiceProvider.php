<?php

namespace App\Providers;

use App\Models\User;
use App\View\Composers\NotificationComposer;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('OnlyInstructor', function ( User $user) {
            return $user->hasRole('instructor');
        });

        Gate::define('OnlyInstructorLesson', function ( User $user) {
            return $user->hasRole('instructor') ;
        });

        View::composer('users.admin.layout.layout', NotificationComposer::class);

    }
}
