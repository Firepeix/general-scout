<?php

namespace App\Infrastructure\Providers;

use App\Infrastructure\Persistence\Repositories\Sources\SourceRepository;
use App\Infrastructure\Persistence\Repositories\Sources\TypedSourceRepository;
use Illuminate\Support\ServiceProvider;

class SourceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(TypedSourceRepository::class, SourceRepository::class);
    }

    public function boot()
    {
        //
    }
}
