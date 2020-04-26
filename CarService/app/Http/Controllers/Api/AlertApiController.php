<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAlert;
use App\Repositories\AlertRepository;
use Illuminate\Http\Request;
use App\Http\Resources\Alert as AlertResource;
use App\Http\Resources\AlertCollection as AlertCollectionResource;

class AlertApiController extends Controller
{
    protected $alertRepository;

    public function __construct(AlertRepository $alertRepository)
    {
        $this->alertRepository = $alertRepository;
    }

    public function find($id)
    {
        $alert = $this->alertRepository->find($id);
        return new AlertResource($alert);
    }

    public function list()
    {
        return new AlertCollectionResource($this->alertRepository->getAll());
    }

    public function store(StoreAlert $request){
        $data = $request->all();
        $alert = $this->alertRepository->create($data);
        return new AlertResource($alert);
    }

    public function update(Request $request, $id)
    {

        $data = $request->all();
        $this->alertRepository->update($data, $id);
        return array("message"=>"success");
    }

    public function destroy($id)
    {
        $this->alertRepository->delete($id);
        return array("message"=>"success");
    }
}
