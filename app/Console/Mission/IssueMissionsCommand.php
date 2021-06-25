<?php


namespace App\Console\Mission;


use App\Application\Decision\AbstractDecision;
use App\Domain\Decision\MissionDecision;
use App\Domain\Mission\Mission;
use App\Domain\Mission\Services\MissionService;
use Illuminate\Console\Command;

class IssueMissionsCommand extends Command
{
    private MissionService $service;
    
    protected $signature = 'mission:issue {code?} {name?} {--async}';
    
    public function __construct(MissionService $service)
    {
        parent::__construct();
        $this->service = $service;
    }
    
    public function handle() : void
    {
        $missions = $this->service->retrieveMission($this->argument('code'), $this->argument('name'));
        $success = function (Mission $mission, MissionDecision $decision) {
            if ($decision->shouldNotify()) {
                $this->line($decision->getTextNotification(AbstractDecision::CLI_OUTPUT));
            }
        };
        
        if ($this->option('async')) {
            $this->service->beginMissionsAsync($missions);
            return;
        }
        $this->service->beginMissionsSync($missions, $success);
    }
    
}
