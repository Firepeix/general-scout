<?php


namespace App\Application\Mission\Services;


use App\Application\Mission\ChapterCheckDecision;
use App\Application\Mission\Events\Check\BeginMission;
use App\Application\Mission\Events\Check\MissionCompleted;
use App\Domain\Decision\MissionDecision;
use App\Domain\Mission\Mission;
use App\Domain\Mission\Repositories\MissionRepository;
use App\Domain\Mission\Services\MissionService as MissionServiceContract;
use App\Domain\Sources\Repositories\SourceRepository;
use Closure;
use Illuminate\Support\Collection;

class MissionService implements MissionServiceContract
{
    private MissionRepository $repository;
    private SourceRepository $sourceRepository;
    
    public function __construct(MissionRepository $repository, SourceRepository $sourceRepository)
    {
        $this->repository = $repository;
        $this->sourceRepository = $sourceRepository;
    }
    
    public function retrieveMission(string $code = null, string $name = null): Collection
    {
        if ($code === null && $name === null) {
            return $this->repository->getAll();
        }
        
        return new Collection([$this->repository->find($code)]);
    }
    
    public function beginMissionsSync(Collection $missions, Closure $success): void
    {
        $missions->each(function (Mission $mission) use ($success){
            $this->beginMission($mission, $success);
        });
    }
    
    public function beginMissionsAsync(Collection $missions): void
    {
        $missions->each(function (Mission $mission) {
            event(new BeginMission($mission));
        });
    }
    
    public function beginMission(Mission $mission, Closure $success = null)
    {
        $decision = $this->realizeMission($mission);
        if ($success !== null) {
            $success($mission, $decision);
        }
        event(new MissionCompleted($decision));
    }
    
    public function realizeMission(Mission $mission): MissionDecision
    {
        dd($mission);
        $source = $this->sourceRepository->findOrFail($mission->getType());
        #TODO Adicionar logica de retornar Decisão
        //$lastChapter = $source->getLastChapter($variation);
        //$variation->addDecision(new ChapterCheckDecision($lastChapter, $manga->getLastReadChapter()));
        //return $variation->getDecision()->hasNewChapter();
    }
}
