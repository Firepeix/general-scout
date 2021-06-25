<?php

namespace App\Infrastructure\Providers;

use App\Application\Mission\Mission;
use App\Application\Mission\Services\MissionService;
use App\Domain\Mission\Mission as MissionContract;
use App\Domain\Mission\Repositories\MissionRepository as MissionRepositoryContract;
use App\Domain\Mission\Services\MissionService as MissionServiceContract;
use App\Infrastructure\Persistence\Repositories\Mission\GoogleSheetMissionRepository;
use Illuminate\Support\ServiceProvider;

class MissionServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(MissionServiceContract::class, MissionService::class);
        $this->app->bind(MissionRepositoryContract::class, GoogleSheetMissionRepository::class);
        $this->app->bind(MissionContract::class, Mission::class);
    }
    
    public function boot()
    {
        //
    }
}
