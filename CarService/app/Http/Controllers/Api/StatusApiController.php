<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStatus;
use App\Repositories\StatusRepository;
use Illuminate\Http\Request;
use App\Http\Resources\Status as StatusResource;
use App\Http\Resources\StatusCollection as StatusCollectionResource;

class StatusApiController extends Controller
{
    protected $statusRepository;

    public function __construct(StatusRepository $statusRepository)
    {
        $this->statusRepository = $statusRepository;
    }

    public function find($id)
    {
        $status = $this->statusRepository->find($id);
        return new StatusResource($status);
    }

    public function list()
    {
        return new StatusCollectionResource($this->statusRepository->getAll());
    }

    public function store(StoreStatus $request){
        $data = $request->all();
        $status = $this->statusRepository->create($data);
        return new StatusResource($status);
    }

    public function update(Request $request, $id)
    {

        $data = $request->all();
        $this->statusRepository->update($data, $id);
        return response()->json(["message" => "success"]);
    }

    public function destroy($id)
    {
        $this->statusRepository->delete($id);
        return response()->json(["message" => "success"]);
    }
}
