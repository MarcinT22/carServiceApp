<?php

namespace App\Repositories;

use App\Models\Event;
use Carbon\Carbon;

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


    public function getAllEvents()
    {
        return $this->model
            ->whereNotNull('start')
            ->whereIn('status_id', [1, 2, 3]);
    }

    public function getTodayEvents()
    {
        return $this->model
            ->whereIn('status_id', [1, 2, 3])
            ->whereDate('start', Carbon::today());

    }

    public function getNumberOfInProgressEvents()
    {
        return $this->model->whereIn('status_id', [2])->get()->count();
    }

    public function getReadyCars()
    {
        return $this->model
            ->with('reportedCar.car')
            ->whereIn('status_id', [4])
            ->get();
    }

    public function getEventDetails($reportedCarId)
    {
        return $this->model->where('reported_car_id', $reportedCarId)->orderBy('id', 'desc')->first();
    }

}
