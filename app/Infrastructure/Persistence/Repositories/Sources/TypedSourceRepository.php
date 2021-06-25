<?php


namespace App\Infrastructure\Persistence\Repositories\Sources;

use App\Domain\Sources\Repositories\SourceRepository as SourceRepositoryContract;
use App\Domain\Sources\Source;
use App\Infrastructure\Persistence\Models\Sources\Source as SourceModel;
use App\Infrastructure\Persistence\Repositories\AbstractRepository;
use App\Infrastructure\Sources\MelhorRastreioSource;

class TypedSourceRepository extends AbstractRepository implements SourceRepositoryContract
{
    public function __construct(SourceModel $model)
    {
        parent::__construct($model);
    }
    
    public function findOrFail(string $id): Source
    {
        return [
            MelhorRastreioSource::TYPE => fn () => new MelhorRastreioSource()
        ][$id]();
    }
    
    protected function map($model): Source
    {
        return $model;
    }
}
