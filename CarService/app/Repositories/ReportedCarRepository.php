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
        return $this->model->where('is_accepted',0)->with('car')->get();
    }


    public function getQuantityNotAccepted()
    {
        return $this->model->where('is_accepted',0)->get()->count();
    }

    public function getQuantityAccepted()
    {
        return $this->model->where('is_accepted',1)->get()->count();
    }


    public function getQuantityDelivered()
    {
        return $this->model->where('is_accepted',1)->where('is_delivered',1)->get()->count();
    }

//    public function getQuantityTodayDelivered()
//    {
//        return $this->model->where('is_accepted',1)->where('is_delivered',1)->get()->count();
//    }

    public function getTodayQuantityDeliveries()
    {
        return $this->model->where('is_accepted',1)->where('is_delivered',1)->get()->count();
    }



    public function acceptDate($id)
    {
      $this->model->find($id)->update(['is_accepted'=>1]);
    }

}
