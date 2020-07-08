<?php

namespace App\Repositories;

use App\Models\Event;

class EventRepository extends BaseRepository
{

    public function __construct(Event $model)
    {
        $this->model = $model;
    }


    public function getNumberOfNewEvents()
    {
        return $this->model
            ->whereIn('status_id', [1, 2, 3])
            ->whereNull('start')
            ->get()->count();
    }

    public function getNumberOfAll()
    {
        return $this->model
            ->whereIn('status_id', [1, 2, 3])
            ->whereNotNull('start')
            ->get()->count();
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
