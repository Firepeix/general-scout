<?php


namespace App\Infrastructure\Sources;


use App\Domain\Sources\MissionCommanderSource;
use GuzzleHttp\Client;

abstract class APISource  extends AbstractSource implements MissionCommanderSource
{
    protected Client $client;
    
    public function __construct()
    {
        $this->client = new Client();
    }
}
