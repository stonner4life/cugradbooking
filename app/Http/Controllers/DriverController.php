<?php

namespace App\Http\Controllers;

use App\Car;
use App\Driver;
use App\Room;
use App\CarTask;
use App\RoomTask;
use App\CameraMan;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function store()
    {

        $roomtasks = RoomTask::all();
        $cartasks = CarTask::all();
        $roomlists = Room::all();
        $carlists = Car::all();
        $drivers = Driver::all();
        $cameramans = CameraMan::all();


        Driver::create([
            'image'=>request('image'),
            'name'=>request('name'),
            'lastname'=>request('lastname'),
            'phoneNumber'=>request('phoneNumber'),

        ]);
        session()->flash('message','เพิ่มพนักงานขับรถใหม่ในระบบสำเร็จ'); //FLASH
        return view('alllists.index ',compact('carlists','roomtasks','cartasks','roomlists','drivers','cameramans'));
    }
}
