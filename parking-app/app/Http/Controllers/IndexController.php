<?php

namespace App\Http\Controllers;

use DateTimeImmutable;
use Faker\Core\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\stringContains;

class IndexController extends Controller
{
    public function index()
    {
        $clientsAndCars =  DB::table('clients')
            ->join('cars', 'clients.id', '=', 'cars.client_id')
            ->select( 'clients.name','clients.surname','clients.patronymic','clients.phone_number',
                'cars.id', 'cars.client_id','cars.brand', 'cars.model', 'cars.body_color', 'cars.state_number' )->latest('cars.created_at')->paginate(4);
        if (isset($cars['items'])){
            $message = 'Парковка пустая';
            return view('home', compact('message'));
        }
        return view('home', compact('clientsAndCars'));
    }


    public function show()
    {
        $clients =  DB::table('clients')->get();
        $clientsAndTheirCars =  DB::table('clients')
            ->join('cars', 'clients.id', '=', 'cars.client_id')
            ->select( 'clients.name','clients.surname','clients.patronymic','clients.phone_number',
                'cars.id', 'cars.client_id','cars.brand', 'cars.model', 'cars.body_color', 'cars.state_number', 'cars.is_a_parking', 'cars.start_parking_time' )->latest('cars.created_at')->paginate(4);
        $this->getParkingTime($clientsAndTheirCars->items());
        if (isset($cars['items'])){
            $message = 'Парковка пустая';
            return view('show', compact('message'));
        }
        return view('show', compact('clientsAndTheirCars', 'clients'));
    }


    public function showCarsClient(Request $request)
    {
        $clientId = $request->get('clientId');
        $cars = DB::table('cars')->where('client_id', (int)$clientId)->paginate(4);
        $this->getParkingTime($cars);
        $client = DB::table('clients')->where('id', (int)$clientId)->first();
        return view('show_cars_client', compact('cars', 'client') );
    }


    private function getParkingTime($cars){
        foreach ($cars as $car){
            if ($car->is_a_parking === 1){
                $now = new DateTimeImmutable(date("Y-m-d H:i:s"));
                $parkingStartTime = new DateTimeImmutable($car->start_parking_time);
                $parkingTime = $now->diff($parkingStartTime);
                $car->parking_time = $parkingTime->format("%a дней %H часов %I минут %S секунд");
            }
        }
    }

}
