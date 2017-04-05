<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\Car;
use App\Driver;
use App\CameraMan;

class AllListController extends Controller
{
    public function index()
    {
        $roomlists = Room::all();
        $carlists = Car::all();
        $drivers = Driver::all();
        $cameramans = CameraMan::all();

        return view('alllists.index',compact('roomlists','carlists','drivers','cameramans'));
    }
}
