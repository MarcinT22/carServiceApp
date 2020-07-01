<?php
namespace App\Repositories;
use App\Models\ReportedCar;

class ReportedCarRepository extends BaseRepository{

    public function __construct(ReportedCar $model)
    {
        $this->model=$model;
    }

    public function getNotAccepted()
    {
        return $this->model->where('is_accepted',0)->get();
    }


    public function getCountNotAccepted()
    {
        return $this->model->where('is_accepted',0)->get()->count();
    }

    public function getCountAccepted()
    {
        return $this->model->where('is_accepted',1)->get()->count();
    }


    public function getCountDelivered()
    {
        return $this->model->where('is_accepted',1)->where('is_delivered',1)->get()->count();
    }


}
