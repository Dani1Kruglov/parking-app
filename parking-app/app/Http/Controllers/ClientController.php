<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Http\Requests\UpdateClientRequest;
use DateTimeImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
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

    protected function getParkingTime($cars){
        foreach ($cars as $car){
            if ($car->is_a_parking === 1){
                $now = new DateTimeImmutable(date("Y-m-d H:i:s"));
                $parkingStartTime = new DateTimeImmutable($car->start_parking_time);
                $parkingTime = $now->diff($parkingStartTime);
                $car->parking_time = $parkingTime->format("%a дней %H часов %I минут %S секунд");
            }
        }
    }

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
            $startParkingTime = "00:00:00";
            if ($data["is_a_parking$i"])
            {
                $startParkingTime = date("Y-m-d H:i:s");
            }
            DB::table('cars')->insert(array(
                'client_id' => $clientId,
                'brand' => $data["brand$i"],
                'model' => $data["model$i"],
                'body_color' => $data["body_color$i"],
                'state_number' => $data["state_number$i"],
                'is_a_parking' => (boolean)$data["is_a_parking$i"],
                'start_parking_time' => $startParkingTime,
                'created_at' => date("Y-m-d H:i:s"),
            ),
            );
        }
        return redirect()->route('index');
    }


    public function edit($clientId)
    {
        $clientId = (int)$clientId;
        $client =  DB::table('clients')->where('id', $clientId)->first();
        $clientCars =  DB::table('cars')->where('client_id', $clientId)->get();
        return view('edit', compact('client', 'clientCars'));
    }

    public function clientUpdate(UpdateClientRequest $request, $clientId){
        $data = $request->validated();
        $clientId = (int)$clientId;
        DB::table('clients')->where('id', $clientId)->update([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'patronymic' => $data['patronymic'],
            'address' => $data['address'],
            'phone_number' => $data['phone_number'],
            'updated_at' =>  date("Y-m-d H:i:s"),
        ]);
        return redirect()->route('edit', $clientId);
    }

    public function clientDestroy($clientId)
    {
        $clientId = (int)$clientId;
        DB::table('cars')->where('client_id', $clientId)->delete();
        DB::table('clients')->where('id', $clientId)->delete();
        return redirect()->route('index');
    }

}
