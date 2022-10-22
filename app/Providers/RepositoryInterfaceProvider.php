<?php

namespace App\Providers;

use App\Http\Interfaces\Admin\Category\CategoryInterface;
use App\Http\Interfaces\Auth\AuthInterface;
use App\Http\Interfaces\RoleUser\RoleUserInterface;
use App\Http\Interfaces\Admin\Product\ProductInterface;
use App\Http\Interfaces\Admin\ProductVariation\ProductVariationInterface;
use App\Http\Interfaces\Cart\CartInterface;
use App\Http\Interfaces\CartProduct\CartProductInterface;
use App\Http\Interfaces\User\UserInterface;
use App\Http\Interfaces\UserFavorite\UserFavoriteInterface;
use App\Http\Interfaces\Admin\Showcase\ShowcaseInterface;
use App\Http\Interfaces\Admin\ProductShowcase\ProductShowcaseInterface;
use App\Http\Repositories\Admin\Category\CategoryRepository;
use App\Http\Repositories\Admin\Product\ProductRepository;
use App\Http\Repositories\Admin\ProductVariation\ProductVariationRepository;
use App\Http\Repositories\Auth\AuthRepository;
use App\Http\Repositories\Cart\CartRepository;
use App\Http\Repositories\RoleUser\RoleUserRepository;
use App\Http\Repositories\User\UserRepository;
use App\Http\Repositories\UserFavorite\UserFavoriteRepository;
use App\Http\Repositories\Admin\Showcase\ShowcaseRepository;
use App\Http\Repositories\Admin\ProductShowcase\ProductShowcaseRepository;
use App\Http\Repositories\CartProduct\CartProductRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryInterfaceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            AuthInterface::class,
            AuthRepository::class
        );

        $this->app->bind(
            UserInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            RoleUserInterface::class,
            RoleUserRepository::class
        );

        $this->app->bind(
            CategoryInterface::class,
            CategoryRepository::class
        );

        $this->app->bind(
            UserFavoriteInterface::class,
            UserFavoriteRepository::class
        );

        $this->app->bind(
            ProductInterface::class,
            ProductRepository::class
        );

        $this->app->bind(
            ShowcaseInterface::class,
            ShowcaseRepository::class
        );

        $this->app->bind(
            ProductShowcaseInterface::class,
            ProductShowcaseRepository::class
        );

        $this->app->bind(
            ProductVariationInterface::class,
            ProductVariationRepository::class
        );

        $this->app->bind(
            CartProductInterface::class,
            CartProductRepository::class
        );

        $this->app->bind(
            CartInterface::class,
            CartRepository::class
        );
    }
}