<?php


namespace App\Infrastructure\Persistence\Repositories\Mission;

use App\Domain\Mission\Mission as MissionContract;
use App\Domain\Mission\Repositories\MissionRepository as MissionRepositoryContract;
use App\Infrastructure\Persistence\Models\Mangas\Manga as MangaModel;
use App\Infrastructure\Persistence\Repositories\AbstractRepository;
use Exception;
use Illuminate\Support\Collection;
use Revolution\Google\Sheets\Contracts\Factory;

class GoogleSheetMissionRepository extends AbstractRepository implements MissionRepositoryContract
{
    private Factory $sheet;

    public function __construct(MangaModel $model, Factory $sheet)
    {
        parent::__construct($model);
        $this->sheet = $sheet->spreadsheet(env('SHEET_ID'))->sheet('Entregas');
    }
    
    public function find(string $id): MissionContract
    {
        throw new Exception('Não implementado');
    }
    
    public function getAll(): Collection
    {
        $mangas = $this->sheet->range('A1:E100')->get()->slice(1)->values();
        return $mangas->map(fn ($model) => $this->map($model));
    }
    
    protected function map($model) : MissionContract
    {
        $manga = app(MissionContract::class);
        $manga->init($model[0], $model[1], $model[3], $model[2]);
        return $manga;
    }
}
