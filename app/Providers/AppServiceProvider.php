<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Repositories\{PermissionRepositoryInterface,
    PlanRepositoryInterface,
    DetailPlanRepositoryInterface,
    ProfileRepositoryInterface,
    UserRepositoryInterface};

use App\Repositories\Eloquent\{DetailPlanRepository,
    PermissionRepository,
    PlanRepository,
    ProfileRepository,
    UserRepository};


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            UserRepositoryInterface::class,
            UserRepository::class,
        );

        $this->app->singleton(
            PlanRepositoryInterface::class,
            PlanRepository::class,
        );

        $this->app->singleton(
            DetailPlanRepositoryInterface::class,
            DetailPlanRepository::class,
        );

        $this->app->singleton(
            ProfileRepositoryInterface::class,
            ProfileRepository::class,
        );

        $this->app->singleton(
            PermissionRepositoryInterface::class,
            PermissionRepository::class,
        );

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
