<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Models\Penggunaan;
use App\Observers\PenggunaanObserver;

class EventServiceProvider extends ServiceProvider
{
    protected $observers = [
        // Penggunaan::class => [PenggunaanObserver::class],
    ];

    public function boot(): void
    {
        //
    }

    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}