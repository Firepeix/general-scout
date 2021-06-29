<?php


namespace App\Application\Decision;


use App\Domain\Decision\MissionDecision;
use App\Domain\Mission\Mission;

abstract class AbstractDecision implements MissionDecision
{
    public const HTML_OUTPUT = 1;
    public const CLI_OUTPUT  = 2;
    
    protected Mission $mission;
    protected mixed   $update;
    protected bool    $hasUpdate;
    
    public function __construct()
    {
        $this->update  = false;
        $this->hasUpdate = false;
    }
    
    public function init(Mission $mission, mixed $update) : MissionDecision
    {
        $this->mission = $mission;
        $this->update  = $update;
        $this->hasUpdate = $this->mission->getLastUpdate() !== $this->update;
        return $this;
    }
    
    public function getMission(): Mission
    {
        return $this->mission;
    }
    
    public function getUpdate(): mixed
    {
        return $this->update;
    }
    
    public function hasUpdate(): bool
    {
        return $this->hasUpdate;
    }
}
