<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCarClientRequest;
use App\Http\Requests\StoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CreateController extends Controller
{
    public function create(){
        return view('create');
    }


    public function store(StoreRequest $request){
        $data = $request->validated();
        $clientId = DB::table('clients')->insertGetId(
            array('name' => $data['name'],
                'surname' => $data['surname'],
                'patronymic' => $data['patronymic'],
                'gender' => $data['gender'],
                'phone_number' => $data['phone_number'],
                'address' => $data['address'],
                'created_at' => date("Y-m-d H:i:s"),)
        );
        for ($i = 1; $i <= (int)$data['number_cars']; $i++) {
            switch ($data["is_a_parking$i"]) {
                case 'true':
                    $isParking = true;
                    $startParkingTime = date("Y-m-d H:i:s");
                    break;
                default:
                    $isParking = false;
                    $startParkingTime = "00:00:00";
                    break;
            }

            DB::table('cars')->insert(array(
                'client_id' => $clientId,
                'brand' => $data["brand$i"],
                'model' => $data["model$i"],
                'body_color' => $data["body_color$i"],
                'state_number' => $data["state_number$i"],
                'is_a_parking' => $isParking,
                'start_parking_time' => $startParkingTime,
                'created_at' => date("Y-m-d H:i:s"),
            ),
            );
        }
        return redirect()->route('index');
    }


    public function addCarClient(AddCarClientRequest $request, $clientId){
        $data = $request->validated();
        switch ($data['is_a_parking']) {
            case 'true':
                $isParking = true;
                $startParkingTime = date("Y-m-d H:i:s");
                break;
            default:
                $isParking = false;
                $startParkingTime = "00:00:00";
                break;
        }
        DB::table('cars')->insert(array(
            'client_id' => $clientId,
            'brand' => $data['brand'],
            'model' => $data['model'],
            'body_color' => $data['body_color'],
            'state_number' => $data[ 'state_number'],
            'is_a_parking' => $isParking,
            'start_parking_time' => $startParkingTime,
            'created_at' => date("Y-m-d H:i:s"),
        ));
        return redirect()->route('index');
    }
}
