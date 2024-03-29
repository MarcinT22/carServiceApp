<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreExistingReportedCar;
use App\Http\Requests\StoreReportedCar;
use App\Models\Car;
use App\Repositories\CarRepository;
use App\Repositories\EventRepository;
use App\Repositories\ReportedCarRepository;
use App\Http\Resources\ReportedCar as ReportedCarResource;
use App\Http\Resources\ReportedCarCollection as ReportedCarCollectionResource;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportedCarApiController extends Controller
{
    protected $reportedCarRepository;
    protected $carRepository;
    protected $eventRepository;

    public function __construct(ReportedCarRepository $reportedCarRepository, CarRepository $carRepository, EventRepository $eventRepository)
    {
        $this->reportedCarRepository = $reportedCarRepository;
        $this->carRepository = $carRepository;
        $this->eventRepository = $eventRepository;
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

    public function storeWithNewCar(StoreReportedCar $request){
        $data = $request->all();

        $carData = [
                'brand'=>$data['brand'],
                'model'=>$data['model'],
                'year'=>$data['year'],
                'fuel'=>$data['fuel'],
                'engine'=>$data['engine'],
                'registration_number'=>$data['registration_number'],
                'vin'=>$data['vin'],
                'password' => bcrypt(substr($data['vin'], -5))
            ];

        $car = $this->carRepository->create($carData);

        $reportedCarDate = Carbon::parse($data['reported_car_date'])->addDay(1);
        $reportedCarData =[
            'car_id'=>$car['id'],
            'description'=>$data['description'],
            'reported_car_date'=>$reportedCarDate->format('Y-m-d'),
            'is_delivered'=>$data['is_delivered'] ?? 0,
            'is_accepted'=>$data['is_accepted'] ?? 0,
        ];

        $reportedCar = $this->reportedCarRepository->create($reportedCarData);


        return new ReportedCarResource([
            'car'=>$car,
            'reportedCar'=>$reportedCar
        ]);
    }
    public function storeWithMyCar(StoreExistingReportedCar $request){


        $data = $request->all();
        $checkIfCarIsReported = $this->reportedCarRepository->checkIfCarIsReported($data['car_id']);
        if (!$checkIfCarIsReported)
        {
            $reportedCarDate = Carbon::parse($data['reported_car_date'])->addDay(1);
            $reportedCarData =[
                'car_id'=>$data['car_id'],
                'description'=>$data['description'],
                'reported_car_date'=>$reportedCarDate->format('Y-m-d'),
                'is_delivered'=>$data['is_delivered'] ?? 0,
                'is_accepted'=>$data['is_accepted'] ?? 0,
            ];

            $reportedCar = $this->reportedCarRepository->create($reportedCarData);

            return new ReportedCarResource([
                'reportedCar'=>$reportedCar
            ]);

        }else{
            return new ReportedCarResource([
                'message'=>'The car has already been reported'
            ]);
        }


    }

    public function update(Request $request, $id)
    {

        $data = $request->all();
        $newReportedCarDate = Carbon::parse($data['new_reported_car_date'])->addDay(1);
        $data['new_reported_car_date'] = $newReportedCarDate->format('Y-m-d');
        $this->reportedCarRepository->update($data, $id);
        return response()->json(["message" => "success"]);
    }

    public function destroy($id)
    {
        $this->reportedCarRepository->delete($id);
        return response()->json(["message" => "success"]);
    }

    public function getNotAccepted()
    {
        $reportedCars = $this->reportedCarRepository->getNotAccepted();
        return new ReportedCarResource([
            'reportedCars'=>$reportedCars
        ]);

    }

    public function getAccepted()
    {
        $reportedCars = $this->reportedCarRepository->getAccepted();
        return new ReportedCarResource([
            'reportedCars'=>$reportedCars
        ]);

    }

    public function acceptDate($id)
    {
        $reportedCars = $this->reportedCarRepository->acceptDate($id);
        return response()->json(["message" => "success"]);
    }

    public function checkIfCarIsReported($id)
    {
        $isCarReported = $this->reportedCarRepository->checkIfCarIsReported($id);
        return response()->json(["isCarReported" => $isCarReported]);

    }


    public function getCarDeliveries()
    {
        $todaysCarDeliveries = $this->reportedCarRepository->getTodayCarDeliveries();
        $remainingCarDeliveries = $this->reportedCarRepository->getRemainingCarDeliveries();
        return new ReportedCarResource([
            'todaysCarDeliveries'=>$todaysCarDeliveries,
            'remainingCarDeliveries'=>$remainingCarDeliveries,
        ]);
    }

    public function confirmCarDelivery($id)
    {
        $this->reportedCarRepository->confirmCarDelivery($id);
        $car = $this->reportedCarRepository->find($id)->car;
        $event = [
            'title'=>$car->brand.' '.$car->model.' '.$car->registration_number,
            'status_id'=>1,
            'reported_car_id'=>$id
        ];
         $this->eventRepository->create($event);

        return response()->json(["message" => "success"]);
    }




}
