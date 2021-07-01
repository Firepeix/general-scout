<?php


namespace App\Domain\Mission\Repositories;

use App\Domain\Decision\MissionDecision;
use App\Domain\Mission\Mission;
use App\Domain\Shared\Repositories\Repository;
use Illuminate\Support\Collection;

interface MissionRepository extends Repository
{
    public function find(string $id): Mission;
    
    public function findChatId(Collection $possible = null) : ? int;
    
    public function updateMission(MissionDecision $decision) : void;
}
