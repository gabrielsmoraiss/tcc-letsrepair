<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Domain\User\UserRepositoryInterface;
use Domain\User\UserRepository;
use Domain\TypeProduct\TypeProductRepositoryInterface;
use Domain\TypeProduct\TypeProductRepository;
use Domain\BrandsAttended\BrandsAttendedRepositoryInterface;
use Domain\BrandsAttended\BrandsAttendedRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            $view->with('current_user', Auth::user());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );
        $this->app->bind(
            TypeProductRepositoryInterface::class,
            TypeProductRepository::class
        );
        $this->app->bind(
            BrandsAttendedRepositoryInterface::class,
            BrandsAttendedRepository::class
        );
    }
}
