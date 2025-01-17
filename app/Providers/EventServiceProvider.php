<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\ActionLogged;
use App\Listeners\LogAction;

class EventServiceProvider extends ServiceProvider
{   
    protected $listen = [
        \App\Events\ActionLogged::class => [
            \App\Listeners\LogAction::class,
        ],
    ];    
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
