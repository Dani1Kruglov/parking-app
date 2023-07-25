<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParkingStatusController extends Controller
{
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
