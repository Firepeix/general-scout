<?php


namespace App\Infrastructure\Sources;

use App\Domain\Sources\MissionCommanderSource;
use Illuminate\Support\Collection;

class MelhorRastreioSource extends CrawlerSource implements MissionCommanderSource
{
    public const TYPE = 1;
    
    public function getLastChapter( $manga): string
    {
        try {
            $crawler = $this->client->request('GET', $this->getUri($manga));
            $text = $crawler->filter('.chapter_issue > a')->first()->text();
            return Collection::make(explode(' ', $text))->last() - 1;
        }catch (\Exception $exception) {
            return 'NONE';
        }
    }
}
