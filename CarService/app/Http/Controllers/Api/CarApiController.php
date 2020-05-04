<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\LoginCar;
use App\Http\Requests\StoreCar;
use App\Models\Car;
use App\Repositories\CarRepository;
use App\Http\Resources\Car as CarResource;
use App\Http\Resources\CarCollection as CarCollectionResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


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
        $data['password'] = bcrypt(substr($data['vin'], -5));
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

    public function login(LoginCar $request)
    {

        request(['registration_number', 'vin']);


        if (!Auth::guard('cars')->attempt([
            'registration_number'=>$request["registration_number"],
            'password'=>$request['vin'],
        ])) {
            return response()->json([
                'message' => 'Unauthorization car'
            ], 401);
        }


        $car = Car::where('registration_number',$request['registration_number'])->first();
        $tokenResult = $car->createToken('Car access token');
        $token = $tokenResult->token;
        $token->save();


        return response()->json([
            'message' => 'Car is logged',
            'access_token' => $tokenResult->accessToken,
            'car'=>$car,
        ]);

    }


}
