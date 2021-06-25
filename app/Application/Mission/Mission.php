<?php


namespace App\Application\Mission;


use App\Domain\Mission\Mission as MissionContract;

class Mission implements MissionContract
{
    private int    $id;
    private string $name;
    private int    $type;
    private string $code;
    private string $lastUpdate;
    private int    $commanderId;
    
    public function init(int $id, string $name, string $code, int $type, string $lastUpdate)
    {
        $this->id         = $id;
        $this->name       = $name;
        $this->type       = $type;
        $this->code       = $code;
        $this->lastUpdate = $lastUpdate;
    }
    
    public function getCommanderId(): int
    {
        return $this->commanderId;
    }
    
    public function setCommanderId(int $id) : MissionContract
    {
        $this->commanderId = $id;
        return $this;
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
    
    public function getId(): int
    {
        return $this->id;
    }
    
    public function setLastUpdate(string $lastUpdate): MissionContract
    {
        $this->lastUpdate = $lastUpdate;
        return $this;
    }
}
