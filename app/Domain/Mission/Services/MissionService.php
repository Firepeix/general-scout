<?php


namespace App\Domain\Mission\Services;


use App\Domain\Decision\MissionDecision;
use App\Domain\Mission\Mission;
use Closure;
use Illuminate\Support\Collection;

interface MissionService
{
    public function retrieveMission(string $code = null, string $name = null) : Collection;
    
    public function realizeMission(Mission $mission) : MissionDecision;
    
    public function beginMission(Mission $mission, Closure $success = null);
    
    public function beginMissionsSync(Collection $missions, Closure $success) : void;
    
    public function beginMissionsAsync(Collection $missions) : void;
}
