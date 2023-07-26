<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCarClientRequest;
use App\Http\Requests\UpdateCarsClientRequest;
use DateTimeImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarController extends ClientController
{
    public function showCarsClient(Request $request)
    {
        $clientId = $request->get('clientId');
        $clientId = (int)$clientId;
        $cars = DB::table('cars')->where('client_id', $clientId)->paginate(4);
        $this->getParkingTime($cars);
        $client = DB::table('clients')->where('id', $clientId)->first();
        return view('show_cars_client', compact('cars', 'client') );
    }

    public function addCarClient(AddCarClientRequest $request, $clientId){
        $data = $request->validated();
        $startParkingTime = "00:00:00";
        if ($data['is_a_parking'])
        {
            $startParkingTime = date("Y-m-d H:i:s");
        }
        DB::table('cars')->insert(array(
            'client_id' => $clientId,
            'brand' => $data['brand'],
            'model' => $data['model'],
            'body_color' => $data['body_color'],
            'state_number' => $data[ 'state_number'],
            'is_a_parking' => (boolean)$data['is_a_parking'],
            'start_parking_time' => $startParkingTime,
            'created_at' => date("Y-m-d H:i:s"),
        ));
        return redirect()->route('index');
    }



    public function carsClientupdate(UpdateCarsClientRequest $request, $clientId){
        $data = $request->validated();
        $clientId = (int)$clientId;
        for ($i = 1; $i <= (int)$data['number_cars']; $i++) {
            $startParkingTime = "00:00:00";
            if ($data["is_a_parking$i"])
            {
                $startParkingTime = date("Y-m-d H:i:s");
            }
            DB::table('cars')->where(function ($query) use ($data, $i, $clientId){
                $query->where('id', $data["id$i"])->where('is_a_parking',  (boolean)$data["is_a_parking$i"])->
                update([
                    'client_id' => $clientId,
                    'brand' => $data["brand$i"],
                    'model' => $data["model$i"],
                    'body_color' => $data["body_color$i"],
                    'state_number' => $data["state_number$i"],
                    'updated_at' =>  date("Y-m-d H:i:s"),]);
            })->orWhere(function ($query) use ($data, $i, $clientId, $startParkingTime){
                $query->where('id', $data["id$i"])->where('is_a_parking', '!=',   (boolean)$data["is_a_parking$i"])->
                update([
                    'client_id' => $clientId,
                    'brand' => $data["brand$i"],
                    'model' => $data["model$i"],
                    'body_color' => $data["body_color$i"],
                    'state_number' => $data["state_number$i"],
                    'is_a_parking' =>  (boolean)$data["is_a_parking$i"],
                    'start_parking_time' => $startParkingTime,
                    'updated_at' =>  date("Y-m-d H:i:s"),]);
            });
        }
        return redirect()->route('edit', (int)$clientId);
    }


    public function carsDestroy($carsId)
    {
        DB::table('cars')->where('id', (int)$carsId)->delete();
        return redirect()->route('index');
    }


    public function removeFromParking($carId)
    {
        DB::table('cars')->where('id', $carId)->update([
            'is_a_parking' => 0,
            'start_parking_time' => "00:00:00"
        ]);
        return redirect('show');
    }
    public function addToParking($carId)
    {
        DB::table('cars')->where('id', $carId)->update([
            'is_a_parking' => 1,
            'start_parking_time' => date("Y-m-d H:i:s"),
        ]);
        return redirect('show');
    }

}
