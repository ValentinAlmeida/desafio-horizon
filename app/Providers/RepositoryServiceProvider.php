<?php

namespace App\Providers;

use App\Repositories\Contracts\{
    BateriaRepositoryInterface,
    NotaRepositoryInterface,
    OndaRepositoryInterface,
    SurfistaRepositoryInterface
};
use App\Repositories\{
    BateriaRepository,
    NotaRepository,
    OndaRepository,
    SurfistaRepository
};
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            BateriaRepositoryInterface::class,
            BateriaRepository::class
        );

        $this->app->bind(
            NotaRepositoryInterface::class,
            NotaRepository::class
        );

        $this->app->bind(
            OndaRepositoryInterface::class,
            OndaRepository::class
        );

        $this->app->bind(
            SurfistaRepositoryInterface::class,
            SurfistaRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
