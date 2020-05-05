<?php

namespace App\Repositories;

use App\Models\Event;

class EventRepository extends BaseRepository
{

    public function __construct(Event $model)
    {
        $this->model = $model;
    }


    public function getAmountAll()
    {
        return $this->model->whereIn('status_id', [1, 2, 3])->get()->count();
    }

    public function getAmountInProgressEvents()
    {
        return $this->model->whereIn('status_id', [2])->get()->count();
    }

    public function getAmountReadyCars()
    {
        return $this->model->whereIn('status_id', [4])->get()->count();
    }

    public function getLastStatusId($reportedCarId)
    {
        return $this->model->where('reported_cars_id',$reportedCarId)->orderBy('id','desc')->first();
    }
}