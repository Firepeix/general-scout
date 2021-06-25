<?php


namespace App\Domain\Decision;


use App\Application\Decision\AbstractDecision;
use App\Domain\Mission\Mission;

interface MissionDecision
{
    public function init(Mission $mission, mixed $update) : self;
    
    public function getMission() : Mission;
    
    public function hasUpdate() : bool;
    
    public function getUpdate() : mixed;
    
    public function shouldNotify() : bool;
    
    public function getTextNotification(int $type = AbstractDecision::HTML_OUTPUT) : string;
    
    public function getCommanderId() : int;
}
