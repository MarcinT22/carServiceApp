<?php
namespace App\Repositories;
use App\Models\Alert;

class AlertRepository extends BaseRepository{

    public function __construct(Alert $model)
    {
        $this->model=$model;
    }

    public function getAcceptedAlerts($id)
    {
        return $this->model
            ->where('event_id',$id)
            ->where('is_accepted',1)
            ->get();
    }

    public function getPendingAlerts($id)
    {
        return $this->model
            ->where('event_id',$id)
            ->whereNull('is_accepted')
            ->get();
    }

    public function getAlertsByEventId($event_id)
    {
        return $this->model
            ->where('event_id',$event_id)
            ->whereNull('is_accepted')
            ->get();
    }
}
