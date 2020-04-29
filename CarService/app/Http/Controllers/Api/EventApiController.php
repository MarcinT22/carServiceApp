<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEvent;
use App\Repositories\EventRepository;
use Illuminate\Http\Request;
use App\Http\Resources\Event as EventResource;
use App\Http\Resources\EventCollection as EventCollectionResource;

class EventApiController extends Controller
{
    protected $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
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

    public function getAmountAll()
    {
        $amount = $this->eventRepository->getAmountAll();

        return array("amount" => "$amount");
    }

    public function getAmountInProgressEvents()
    {
        $amount = $this->eventRepository->getAmountInProgressEvents();

        return array("amount" => "$amount");
    }

    public function getAmountReadyCars()
    {
        $amount = $this->eventRepository->getAmountReadyCars();

        return array("amount" => "$amount");
    }
}
