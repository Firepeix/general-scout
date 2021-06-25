<?php


namespace App\Domain\Sources;

use App\Domain\Decision\MissionDecision;
use App\Domain\Mission\Mission;

interface Source
{
    public function scout(Mission $mission) : MissionDecision;
}
