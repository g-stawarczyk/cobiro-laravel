<?php

namespace App\Providers;

use Gstawarczyk\Cobiro\Domain\Model\Product;
use Gstawarczyk\Cobiro\Domain\Repository\ProductRepository;
use Illuminate\Support\ServiceProvider;
use LaravelDoctrine\ORM\Facades\EntityManager;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductRepository::class, function () {
            return EntityManager::getRepository(Product::class);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
