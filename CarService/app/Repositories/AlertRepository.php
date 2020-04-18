<?php
namespace App\Repositories;
use App\Models\Alert;

class AlertRepository extends BaseRepository{

    public function __construct(Alert $model)
    {
        $this->model=$model;
    }
}