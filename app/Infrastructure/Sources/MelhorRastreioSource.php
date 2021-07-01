<?php


namespace App\Infrastructure\Sources;

use App\Domain\Decision\MissionDecision;
use App\Domain\Mission\Mission;
use App\Domain\Sources\MissionCommanderSource;
use Illuminate\Support\Collection;

class MelhorRastreioSource extends APISource implements MissionCommanderSource
{
    public const TYPE = 1;
    public const URI = 'https://api.melhorrastreio.com.br/api/v1/trackings';
    public const IN_TRANSIT = 'movement';
    
    public function scout(Mission $mission): MissionDecision
    {
        $decision = app()->make(MissionDecision::class);
        $response = $this->client->get(self::URI . "/{$mission->getCode()}");
        $response = json_decode($response->getBody()->getContents(), true);
        if ($response['success']) {
            $update = $this->parseResponse($response);
            $decision->init($mission, $update);
            return $decision;
        }
        return $decision;
    }
    
    private function parseResponse(array $response) : string
    {
        $event = Collection::make($response['data']['events'])->last();
        $status = $event['events'];
        if ($response['data']['status'] === self::IN_TRANSIT) {
            return str_replace('- por favor aguarde', "para {$event['destination_city']}", $status);
        }
        
        return $status;
    }
}
