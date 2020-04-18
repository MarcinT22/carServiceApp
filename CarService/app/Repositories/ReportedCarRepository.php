<?php
namespace App\Repositories;
use App\Models\ReportedCar;

class ReportedCarRepository extends BaseRepository{

    public function __construct(ReportedCar $model)
    {
        $this->model=$model;
    }
}