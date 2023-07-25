<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCarsClientRequest;
use App\Http\Requests\UpdateClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EditController extends Controller
{
    public function edit($clientId)
    {
        $client =  DB::table('clients')->where('id', (int)$clientId)->first();
        $clientCars =  DB::table('cars')->where('client_id', (int)$clientId)->get();
        return view('edit', compact('client', 'clientCars'));
    }

    public function clientUpdate(UpdateClientRequest $request, $clientId){
        $data = $request->validated();
        DB::table('clients')->where('id', (int)$clientId)->update([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'patronymic' => $data['patronymic'],
            'address' => $data['address'],
            'phone_number' => $data['phone_number'],
            'updated_at' =>  date("Y-m-d H:i:s"),
        ]);
        return redirect()->route('edit', (int)$clientId);
    }


    public function carsClientupdate(UpdateCarsClientRequest $request, $clientId){
        $data = $request->validated();
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
            DB::table('cars')->where(function ($query) use ($data, $i, $isParking, $clientId){
                $query->where('id', $data["id$i"])->where('is_a_parking', $isParking)->
                update([
                    'client_id' => (int)$clientId,
                    'brand' => $data["brand$i"],
                    'model' => $data["model$i"],
                    'body_color' => $data["body_color$i"],
                    'state_number' => $data["state_number$i"],
                    'updated_at' =>  date("Y-m-d H:i:s"),]);
            })->orWhere(function ($query) use ($data, $i, $isParking, $clientId, $startParkingTime){
                $query->where('id', $data["id$i"])->where('is_a_parking', '!=',  $isParking)->
                update([
                    'client_id' => (int)$clientId,
                    'brand' => $data["brand$i"],
                    'model' => $data["model$i"],
                    'body_color' => $data["body_color$i"],
                    'state_number' => $data["state_number$i"],
                    'is_a_parking' => $isParking,
                    'start_parking_time' => $startParkingTime,
                    'updated_at' =>  date("Y-m-d H:i:s"),]);
            });
        }
        return redirect()->route('edit', (int)$clientId);
    }
}

