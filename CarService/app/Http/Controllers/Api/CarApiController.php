<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCar;
use App\Repositories\CarRepository;
use App\Http\Resources\Car as CarResource;
use App\Http\Resources\CarCollection as CarCollectionResource;
use Illuminate\Http\Request;


class CarApiController extends Controller
{

    protected $carRepository;

    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    public function find($id)
    {
        $car = $this->carRepository->find($id);
        return new CarResource($car);
    }

    public function list()
    {
        return new CarCollectionResource($this->carRepository->getAll());
    }

    public function store(StoreCar $request){
        $data = $request->all();
        $car = $this->carRepository->create($data);
        return new CarResource($car);
    }

    public function update(Request $request, $id)
    {

        $data = $request->all();
        $this->carRepository->update($data, $id);
        return array("message"=>"success");
    }

    public function destroy($id)
    {
        $this->carRepository->delete($id);
        return array("message"=>"success");
    }

}
