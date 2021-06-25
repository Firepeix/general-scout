<?php


namespace App\Application\Mission\Listeners\Check;


use App\Application\Mission\Events\Check\BeginMission;
use App\Domain\Mission\Services\MissionService;
use Illuminate\Contracts\Queue\ShouldQueue;

class BeginMissionHandler implements ShouldQueue
{
    private MissionService $service;
    
    public function __construct(MissionService $service)
    {
        $this->service = $service;
    }
    
    public function handle(BeginMission $mission) : void
    {
        $this->service->beginMission($mission->getMission());
    }
}
