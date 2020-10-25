<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAlert;
use App\Repositories\AlertRepository;
use App\Repositories\EventRepository;
use Illuminate\Http\Request;
use App\Http\Resources\Alert as AlertResource;
use App\Http\Resources\AlertCollection as AlertCollectionResource;

class AlertApiController extends Controller
{
    protected $alertRepository;
    protected $eventRepository;

    public function __construct(AlertRepository $alertRepository, EventRepository $eventRepository)
    {
        $this->alertRepository = $alertRepository;
        $this->eventRepository = $eventRepository;
    }

    public function find($id)
    {
        $alert = $this->alertRepository->find($id);
        return new AlertResource($alert);
    }

    public function list()
    {
        return new AlertCollectionResource($this->alertRepository->getAll());
    }

    public function store(StoreAlert $request){
        $data = $request->all();
        $alert = $this->alertRepository->create($data);
        return new AlertResource($alert);
    }

    public function update(Request $request, $id)
    {

        $data = $request->all();
        $this->alertRepository->update($data, $id);
        return array("message"=>"success");
    }

    public function destroy($id)
    {
        $this->alertRepository->delete($id);
        return array("message"=>"success");
    }

    public function getAcceptedAlerts($id)
    {
        $acceptedAlerts = $this->alertRepository->getAcceptedAlerts($id);
        return new AlertResource($acceptedAlerts);
    }

    public function getPendingAlerts($id)
    {
        $pendingAlerts = $this->alertRepository->getPendingAlerts($id);
        return new AlertResource($pendingAlerts);
    }

    public function acceptAlert($id)
    {
        $data['is_accepted'] = 1;
        $this->alertRepository->update($data, $id);
        return array("message"=>"success");
    }

    public function notAcceptAlert($id)
    {
        $data['is_accepted'] = 0;
        $this->alertRepository->update($data, $id);
        return array("message"=>"success");
    }

    public function getNewAlerts($id)
    {
        $event = $this->eventRepository->getEventDetails($id);
        if (!isset($event))
        {
            $alerts = [];
        }else{
            $alerts = $this->alertRepository->getAlertsByEventId($event->id);
        }

        return array(
            "alerts" => $alerts,
        );
    }


}
