<?php

namespace App\Infrastructure\Providers;

use App\Domain\Sources\Repositories\SourceRepository;
use App\Infrastructure\Persistence\Repositories\Sources\TypedSourceRepository;
use Illuminate\Support\ServiceProvider;

class SourceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(SourceRepository::class, TypedSourceRepository::class);
    }

    public function boot()
    {
        //
    }
}
