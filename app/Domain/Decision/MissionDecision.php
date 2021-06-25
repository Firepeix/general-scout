<?php


namespace App\Domain\Decision;


use App\Application\Decision\AbstractDecision;

interface MissionDecision
{
    public function shouldNotify() : bool;
    
    public function getTextNotification(int $type = AbstractDecision::HTML_OUTPUT) : string;
    
    public function getCommanderId() : int;
}
