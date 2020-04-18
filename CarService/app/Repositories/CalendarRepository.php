<?php
namespace App\Repositories;
use App\Models\Calendar;

class CalendarRepository extends BaseRepository{

    public function __construct(Calendar $model)
    {
        $this->model=$model;
    }
}