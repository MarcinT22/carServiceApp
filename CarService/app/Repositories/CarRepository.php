<?php
namespace App\Repositories;
use App\Models\Car;

class CarRepository extends BaseRepository{

    public function __construct(Car $model)
    {
        $this->model=$model;
    }
}