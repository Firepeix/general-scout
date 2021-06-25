<?php


namespace App\Application\Mission\Events\Check;

use App\Domain\Decision\MissionDecision;
use Illuminate\Support\Facades\Event;

class MissionCompleted extends Event
{
    private MissionDecision $decision;
    
    public function __construct(MissionDecision $decision)
    {
        $this->decision = $decision;
    }
    
    public function getDecision(): MissionDecision
    {
        return $this->decision;
    }
}
