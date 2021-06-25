<?php

namespace App\Providers;

use App\Application\Mission\Events\Check\BeginMission;
use App\Application\Mission\Events\Check\MissionCompleted;
use App\Application\Mission\Listeners\Check\BeginMissionHandler;
use App\Application\Mission\Listeners\Check\MissionResultsSendNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        BeginMission::class => [BeginMissionHandler::class],
        MissionCompleted::class => [MissionResultsSendNotification::class]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
