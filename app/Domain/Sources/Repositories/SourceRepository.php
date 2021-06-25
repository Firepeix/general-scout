<?php


namespace App\Domain\Sources\Repositories;


use App\Domain\Shared\Repositories\Repository;
use App\Domain\Sources\Source;

interface SourceRepository extends Repository
{
    public function findOrFail(string $id): Source;
}
