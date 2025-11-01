<?php

namespace App\Http\Controllers;

use App\ReenactmentEvent\Application\Dto\ReenactmentEventRequestData;
use App\ReenactmentEvent\Application\UseCase\AddReenactmentEvent\AddReenactmentEvent;
use App\ReenactmentEvent\Infrastructure\Repository\Persistence\Eloquent\Model\EloquentReenactmentEvent;


class TestController// przeniesc
{
    /**
     * Display a listing of the resource.
     */
    public function index(AddReenactmentEvent $addReenactmentEvent)
    {
        $addReenactmentEvent(new ReenactmentEventRequestData());

        $events = EloquentReenactmentEvent::with('participants')->get();

        foreach($events as $event) {
            dump($event->participants);
        }
    }
}
