<?php


namespace App\Application\Mission;


use App\Domain\Mission\Mission as MissionContract;

class Mission implements MissionContract
{
    private string $name;
    private int    $type;
    private string $code;
    private string $lastUpdate;
    
    public function init(string $name, string $code, int $type, string $lastUpdate)
    {
        $this->name       = $name;
        $this->type       = $type;
        $this->code       = $code;
        $this->lastUpdate = $lastUpdate;
    }
    
    public function getName(): string
    {
        return $this->name;
    }
    
    public function getType(): int
    {
        return $this->type;
    }
    
    public function getCode(): string
    {
        return $this->code;
    }
    
    public function getLastUpdate(): string
    {
        return $this->lastUpdate;
    }
}
