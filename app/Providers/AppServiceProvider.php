<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Validator;
use Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // DB::listen(function ($query) {
        //     Log::info($query->sql);
        // });

        Validator::extend('id_valid', 'App\Validators\IDValidator@validate');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Interfaces\CentreRepositoryInterface',
            'App\Repositories\Implementations\EloquentCentreRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\StaffRepositoryInterface',
            'App\Repositories\Implementations\EloquentStaffRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\CentreClassRepositoryInterface',
            'App\Repositories\Implementations\EloquentCentreClassRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\ChildRepositoryInterface',
            'App\Repositories\Implementations\EloquentChildRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\ECDQualificationRepositoryInterface',
            'App\Repositories\Implementations\EloquentECDQualificationRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\ChildAttendanceRepositoryInterface',
            'App\Repositories\Implementations\EloquentChildAttendanceRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\AdminRepositoryInterface',
            'App\Repositories\Implementations\EloquentAdminRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\ExternalRepositoryInterface',
            'App\Repositories\Implementations\EloquentExternalRepository'
        );
    }
}
