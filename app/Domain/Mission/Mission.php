<?php


namespace App\Domain\Mission;

interface Mission
{
    public function init(int $id, string $name, string $code, int $type, string $lastUpdate);
    
    public function getId() : int;
    
    public function getName() : string;
    
    public function getCode() : string;
    
    public function getType() : int;
    
    public function getLastUpdate() : string;
    
    public function setLastUpdate(string $lastUpdate) : self;
    
    public function getCommanderId(): int;
    
    public function setCommanderId(int $id) : self;
}
