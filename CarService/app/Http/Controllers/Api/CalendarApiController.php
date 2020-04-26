<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCalendar;
use App\Repositories\CalendarRepository;
use Illuminate\Http\Request;
use App\Http\Resources\Calendar as CalendarResource;
use App\Http\Resources\CalendarCollection as CalendarCollectionResource;

class CalendarApiController extends Controller
{
    protected $calendarRepository;

    public function __construct(CalendarRepository $calendarRepository)
    {
        $this->calendarRepository = $calendarRepository;
    }

    public function find($id)
    {
        $calendar = $this->calendarRepository->find($id);
        return new CalendarResource($calendar);
    }

    public function list()
    {
        return new CalendarCollectionResource($this->calendarRepository->getAll());
    }

    public function store(StoreCalendar $request){
        $data = $request->all();
        $calendar = $this->calendarRepository->create($data);
        return new CalendarResource($calendar);
    }

    public function update(Request $request, $id)
    {

        $data = $request->all();
        $this->calendarRepository->update($data, $id);
        return array("message"=>"success");
    }

    public function destroy($id)
    {
        $this->calendarRepository->delete($id);
        return array("message"=>"success");
    }
}
