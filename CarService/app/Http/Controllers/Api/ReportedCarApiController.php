<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreReportedCar;
use App\Models\Car;
use App\Repositories\ReportedCarRepository;
use App\Http\Resources\ReportedCar as ReportedCarResource;
use App\Http\Resources\ReportedCarCollection as ReportedCarCollectionResource;
use Illuminate\Http\Request;

class ReportedCarApiController extends Controller
{
    protected $reportedCarRepository;

    public function __construct(ReportedCarRepository $reportedCarRepository)
    {
        $this->reportedCarRepository = $reportedCarRepository;
    }

    public function find($id)
    {
        $reportedCar = $this->reportedCarRepository->find($id);
        return new ReportedCarResource($reportedCar);
    }

    public function list()
    {
        return new ReportedCarCollectionResource($this->reportedCarRepository->getAll());
    }

    public function store(StoreReportedCar $request){
        $data = $request->all();

        $car = Car::create([
            'brand'=>$data['brand'],
            'model'=>$data['model'],
            'year'=>$data['year'],
            'fuel'=>$data['fuel'],
            'engine'=>$data['engine'],
            'registration_number'=>$data['registration_number'],
            'vin'=>$data['vin']
        ]);

        $reportedCardata =[
            'car_id'=>$car['id'],
            'description'=>$data['description'],
            'reported_car_date'=>$data['reported_car_date'],
            'is_delivered'=>$data['is_delivered'],
            'is_accepted'=>$data['is_accepted'],
        ];

        $reportedCar = $this->reportedCarRepository->create($reportedCardata);


        return new ReportedCarResource([
            'car'=>$car,
            'reportedCar'=>$reportedCar
        ]);
    }

    public function update(Request $request, $id)
    {

        $data = $request->all();
        $this->reportedCarRepository->update($data, $id);
        return array("message"=>"success");
    }

    public function destroy($id)
    {
        $this->reportedCarRepository->delete($id);
        return array("message"=>"success");
    }
}
