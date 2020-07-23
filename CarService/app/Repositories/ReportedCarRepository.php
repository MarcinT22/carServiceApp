<?php

namespace App\Repositories;

use App\Models\ReportedCar;
use Carbon\Carbon;


class ReportedCarRepository extends BaseRepository
{

    public function __construct(ReportedCar $model)
    {
        $this->model = $model;
    }

    public function getNotAccepted()
    {
        return $this->model->where('is_accepted', 0)
            ->whereNull('new_reported_car_date')
            ->with('car')
            ->orderBy('reported_car_date', 'ASC')
            ->get();
    }


    public function getAccepted()
    {
        return $this->model
            ->where('is_accepted', 1)
            ->where('is_delivered', 0)
            ->with('car')
            ->get();
    }

    public function getTodayCarDeliveries()
    {
        return $this->model
            ->with('car')
            ->where(function ($query) {
                $query->whereDate('reported_car_date', Carbon::today())
                    ->whereNull('new_reported_car_date')
                    ->where('is_accepted', 1)
                    ->where('is_delivered', 0);
            })
            ->orWhere(function ($query) {
                $query->whereDate('new_reported_car_date', Carbon::today())
                    ->where('is_accepted', 1)
                    ->where('is_delivered', 0);
            })
            ->get();
    }

    public function getRemainingCarDeliveries()
    {
        return $this->model
            ->where('is_accepted', 1)
            ->where('is_delivered', 0)
            ->with('car')
            ->where(function ($query) {
                $query->whereDate('reported_car_date', '!=', Carbon::today())
                    ->whereNull('new_reported_car_date');
            })
            ->orWhere(function ($query) {
                $query->whereDate('new_reported_car_date', '!=', Carbon::today());
            })
            ->orderBy('reported_car_date', 'ASC')
            ->orderBy('new_reported_car_date', 'ASC')
            ->get();
    }


    public function acceptDate($id)
    {
        $this->model->find($id)->update(['is_accepted' => 1]);
    }


    public function checkIfCarIsReported($id)
    {
        $reportedCars = $this->model
            ->where('car_id', $id)
            ->with('event')
            ->orderBy('id', 'desc')
            ->get();


        if (count($reportedCars) == 0) {
            return false;
        } else {
            foreach ($reportedCars as $item) {
                if ($item->event) {
                    if ($item->event->status_id == 5) {
                        return false;
                    } else {
                        return true;
                    }
                } else {
                    return true;
                }
            }
        }


    }

    public function confirmCarDelivery($id)
    {
        $this->model->find($id)->update(['is_delivered' => 1]);
    }

}
