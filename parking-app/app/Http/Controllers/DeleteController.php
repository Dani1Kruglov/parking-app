<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeleteController extends Controller
{
    public function carsDestroy($carsId)
    {
        DB::table('cars')->where('id', (int)$carsId)->delete();
        return redirect()->route('index');
    }

    public function clientDestroy($clientId)
    {
        DB::table('cars')->where('client_id', (int)$clientId)->delete();
        DB::table('clients')->where('id', (int)$clientId)->delete();
        return redirect()->route('index');
    }
}
