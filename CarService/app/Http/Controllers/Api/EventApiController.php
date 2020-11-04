<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEvent;
use App\Repositories\AlertRepository;
use App\Repositories\EventRepository;
use App\Repositories\StatusRepository;
use Illuminate\Http\Request;
use App\Http\Resources\Event as EventResource;
use App\Http\Resources\EventCollection as EventCollectionResource;
use Carbon\Carbon;

class EventApiController extends Controller
{
    protected $eventRepository;
    protected $statusRepository;
    protected $alertRepository;

    public function __construct(EventRepository $eventRepository, StatusRepository $statusRepository, AlertRepository $alertRepository)
    {
        $this->eventRepository = $eventRepository;
        $this->statusRepository = $statusRepository;
        $this->alertRepository = $alertRepository;
    }

    public function find($id)
    {
        $event = $this->eventRepository->find($id);
        return new EventResource($event);
    }

    public function list()
    {
        return new EventCollectionResource($this->eventRepository->getAll());
    }

    public function store(StoreEvent $request)
    {
        $data = $request->all();
        $event = $this->eventRepository->create($data);
        return new EventResource($event);
    }

    public function update(Request $request, $id)
    {

        $data = $request->all();
        if (isset($data['start'])) {
            $data['start'] = (Carbon::parse($data['start'])->addDay(1))->format('Y-m-d');
        }
        $this->eventRepository->update($data, $id);
        return array("message" => "success");
    }

    public function destroy($id)
    {
        $this->eventRepository->delete($id);
        return array("message" => "success");
    }


    public function getEventStatus($id)
    {

        $eventDetails = $this->eventRepository->getEventDetails($id);
        $status = $this->statusRepository->find($eventDetails['status_id']);

        return new EventResource([
            'status'=>$status,
            'eventDetails'=> $eventDetails
        ]);
    }

    public function getNewEvents()
    {
        $newEvents = $this->eventRepository->getNewEvents();
        return new EventResource($newEvents);
    }

    public function getSheduledEvents()
    {
        $sheduledEvents = $this->eventRepository->getSheduledEvents();
        return new EventResource($sheduledEvents);
    }

    public function getReadyCars()
    {
        $readyCars = $this->eventRepository->getReadyCars();
        return new EventResource($readyCars);
    }


//    public function getNumberOfAcceptedAlerts($id)
//    {
//        $event = $this->eventRepository->getEventDetails($id);
//        $numberOfAcceptedAlerts = $this->alertRepository->getAcceptedAlerts($event->id)->count();
//        return array(
//            "numberOfAcceptedAlerts" => $numberOfAcceptedAlerts,
//        );
//    }


}
