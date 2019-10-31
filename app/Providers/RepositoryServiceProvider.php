<?php

namespace App\Providers;

use App\Cloudsa9\Repositories\Subscriber\AccountRepository;
use App\Cloudsa9\Repositories\Subscriber\AccountRepositoryEloquent;
use App\Cloudsa9\Repositories\Subscriber\ContactInfoRepository;
use App\Cloudsa9\Repositories\Subscriber\ContactInfoRepositoryEloquent;
use App\Cloudsa9\Repositories\Subscriber\LockscreenRepository;
use App\Cloudsa9\Repositories\Subscriber\LockscreenRepositoryEloquent;
use App\Cloudsa9\Repositories\User\UserRepository;
use App\Cloudsa9\Repositories\User\UserRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $repositories = [
        UserRepository::class => UserRepositoryEloquent::class,
        AccountRepository::class => AccountRepositoryEloquent::class,
        ContactInfoRepository::class => ContactInfoRepositoryEloquent::class,
        LockscreenRepository::class => LockscreenRepositoryEloquent::class,
    ];

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }
}
