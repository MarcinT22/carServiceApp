<?php

namespace App\Repositories;

use App\Models\ReportedCar;
use Carbon\Carbon;
use function foo\func;

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
            ->get();
    }


    public function getQuantityNotAccepted()
    {
        return $this->model->where('is_accepted', 0)->get()->count();
    }

    public function getQuantityAccepted()
    {
        return $this->model->where('is_accepted', 1)->get()->count();
    }

    public function getQuantityDeliveriesToday()
    {

        return $this->model
            ->where(function ($query) {
                $query->whereDate('reported_car_date', Carbon::today())
                    ->where('is_accepted', 1);
            })
            ->orWhere(function ($query) {
                $query->whereDate('new_reported_car_date', Carbon::today())
                    ->where('is_accepted', 1);
            })
            ->get()
            ->count();
    }

    public function getQuantityDelivered()
    {
        return $this->model->where('is_accepted', 1)->where('is_delivered', 1)->get()->count();
    }


    public function acceptDate($id)
    {
        $this->model->find($id)->update(['is_accepted' => 1]);
    }

}
