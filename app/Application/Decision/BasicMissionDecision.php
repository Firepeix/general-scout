<?php


namespace App\Application\Decision;


use App\Domain\Decision\MissionDecision;

class BasicMissionDecision extends AbstractDecision implements MissionDecision
{
    public function shouldNotify(): bool
    {
        return $this->hasUpdate();
    }
    
    public function getTextNotification(int $type = AbstractDecision::HTML_OUTPUT): string
    {
        $endpoint = $type === AbstractDecision::HTML_OUTPUT ? '</b>' : '</>';
        if ($type === AbstractDecision::HTML_OUTPUT) {
            return "Nova atualização para objeto <b>{$this->mission->getName()}$endpoint: <b>{$this->update}$endpoint";
    
        }
        return "Nova atualização para objeto <fg=cyan>{$this->mission->getName()}$endpoint: <fg=green>{$this->update}$endpoint";
    }
    
    public function getCommanderId(): int
    {
        return $this->mission->getCommanderId();
    }
    
}
