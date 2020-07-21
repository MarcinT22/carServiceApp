<?php

namespace App\Repositories;

use App\Models\Event;

class EventRepository extends BaseRepository
{

    public function __construct(Event $model)
    {
        $this->model = $model;
    }

    public function getAllEvent()
    {
        return $this->model
            ->with('reportedCar.car')
            ->with('status')
            ->get();
    }


    public function getNewEvents()
    {
       return $this->getAllEvent()->whereNull('start')->whereIn('status_id', [1, 2, 3]);
    }

    public function getSheduledEvents()
    {
        return $this->getAllEvent()->whereNotNull('start');
    }


    public function getNumberOfAll()
    {
        return $this->getAll()
            ->whereNotNull('start')
            ->whereIn('status_id', [1, 2, 3])
            ->count();

    }

    public function getNumberOfInProgressEvents()
    {
        return $this->model->whereIn('status_id', [2])->get()->count();
    }

    public function getNumberOfReadyCars()
    {
        return $this->model->whereIn('status_id', [4])->get()->count();
    }

    public function getLastStatusId($reportedCarId)
    {
        return $this->model->where('reported_car_id',$reportedCarId)->orderBy('id','desc')->first();
    }
}
