<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEvent;
use App\Repositories\EventRepository;
use App\Repositories\StatusRepository;
use Illuminate\Http\Request;
use App\Http\Resources\Event as EventResource;
use App\Http\Resources\EventCollection as EventCollectionResource;

class EventApiController extends Controller
{
    protected $eventRepository;
    protected $statusRepository;

    public function __construct(EventRepository $eventRepository, StatusRepository $statusRepository)
    {
        $this->eventRepository = $eventRepository;
        $this->statusRepository = $statusRepository;
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
        $this->eventRepository->update($data, $id);
        return array("message" => "success");
    }

    public function destroy($id)
    {
        $this->eventRepository->delete($id);
        return array("message" => "success");
    }



    public function getEventStatus($reportedCarId)
    {

        $lastStatus = $this->eventRepository->getLastStatusId($reportedCarId);
        $status = $this->statusRepository->find($lastStatus['status_id']);

        return array($status);
    }
}
