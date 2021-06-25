<?php


namespace App\Application\Mission\Events\Check;


use App\Domain\Mission\Mission;
use Illuminate\Support\Facades\Event;

class BeginMission extends Event
{
    private Mission $mission;
    
    public function __construct(Mission $mission)
    {
        $this->mission = $mission;
    }
    
    public function getMission(): Mission
    {
        return $this->mission;
    }
    
}
