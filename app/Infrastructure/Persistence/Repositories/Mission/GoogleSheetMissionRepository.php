<?php


namespace App\Infrastructure\Persistence\Repositories\Mission;

use App\Domain\Decision\MissionDecision;
use App\Domain\Mission\Mission as MissionContract;
use App\Domain\Mission\Repositories\MissionRepository as MissionRepositoryContract;
use App\Infrastructure\Persistence\Models\Mangas\Manga as MangaModel;
use App\Infrastructure\Persistence\Repositories\AbstractRepository;
use Exception;
use Illuminate\Support\Collection;
use Revolution\Google\Sheets\Contracts\Factory;

class GoogleSheetMissionRepository extends AbstractRepository implements MissionRepositoryContract
{
    private const ID_POSITION = 5;
    private const CODE_POSITION = 1;
    private const CHAT_ID_POSITION = 12;
    
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
        $missions = $this->sheet->range('A1:M100')->get()->slice(1)->values();
        $offset = 2;
        $chatId = $this->findChatId($missions);
        return $missions->filter(fn (array $mission) => isset($mission[self::CODE_POSITION]))->map(function (array $model, int $key) use ($offset, $chatId){
            $model[self::ID_POSITION] = $key + $offset;
            return $this->map($model)->setCommanderId($chatId);
        });
    }
    
    public function updateMission(MissionDecision $decision): void
    {
        $update = $decision->getUpdate();
        $mission = $decision->getMission();
        $mission->setLastUpdate($update);
        $this->sheet->range("C{$mission->getId()}")->update([[$update]]);
    }
    
    public function findChatId(Collection $possible = null): ?int
    {
        if ($possible === null) {
            $possible = $this->sheet->range('A1:M100')->get()->slice(1)->values();
        }

        return $possible[0][self::CHAT_ID_POSITION];
    }
    
    protected function map($model) : MissionContract
    {
        $manga = app(MissionContract::class);
        $manga->init($model[self::ID_POSITION], $model[0], $model[self::CODE_POSITION], $model[3], $model[2]);
        return $manga;
    }
}
