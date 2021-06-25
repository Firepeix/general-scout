<?php


namespace App\Application\Mission\Listeners\Check;


use App\Application\Mission\Events\Check\MangaWasChecked;
use App\Application\Mission\Events\Check\MissionCompleted;
use App\Domain\Notification\Services\NotificationService;
use App\Domain\Notification\TextMessage;
use Illuminate\Contracts\Queue\ShouldQueue;

class MissionResultsSendNotification implements ShouldQueue
{
    private NotificationService $service;
    private TextMessage $message;
    
    public function __construct(NotificationService $service, TextMessage $message)
    {
        $this->service = $service;
        $this->message = $message;
    }
    
    public function handle(MissionCompleted $completedMission) : void
    {
        $decision = $completedMission->getDecision();
        if ($decision->shouldNotify()) {
            //$message = $this->message->init("O manga <b>{$manga->getName()}</b> tem o novo capitulo: <b>{$decision->getNewChapter()}</b>");
            $message = $this->message->init($decision->getTextNotification());
            $this->service->send($message, $decision->getCommanderId());
        }
    }
}
