<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreReportedCar;
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
        $reportedCar = $this->reportedCarRepository->create($data);
        return new ReportedCarResource($reportedCar);
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
