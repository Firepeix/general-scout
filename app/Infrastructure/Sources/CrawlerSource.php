<?php


namespace App\Infrastructure\Sources;


use App\Domain\Sources\MissionCommanderSource;
use Goutte\Client;

abstract class CrawlerSource  extends AbstractSource implements MissionCommanderSource
{
    protected Client $client;
    
    public function __construct()
    {
        $this->client = new Client();
    }
}
