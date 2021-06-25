<?php


namespace App\Domain\Mission;

interface Mission
{
    public function init(string $name, string $code, int $type, string $lastUpdate);
    
    public function getName() : string;
    
    public function getCode() : string;
    
    public function getType() : int;
    
    public function getLastUpdate() : string;
}
