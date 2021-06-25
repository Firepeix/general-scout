<?php


namespace App\Domain\Mission\Repositories;

use App\Domain\Mission\Mission;
use App\Domain\Shared\Repositories\Repository;

interface MissionRepository extends Repository
{
    public function find(string $id): Mission;
}
