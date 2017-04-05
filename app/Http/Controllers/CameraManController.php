<?php

namespace App\Http\Controllers;

use App\CameraMan;
use App\Car;
use App\Room;
use App\CarTask;
use App\Driver;
use App\RoomTask;
use Illuminate\Http\Request;

class CameraManController extends Controller
{
    public function store()
    {

        $roomtasks = RoomTask::all();
        $cartasks = CarTask::all();
        $roomlists = Room::all();
        $carlists = Car::all();
        $drivers = Driver::all();
        $cameramans = CameraMan::all();


        CameraMan::create([
            'image'=>request('image'),
            'name'=>request('name'),
            'lastname'=>request('lastname'),
            'phoneNumber'=>request('phoneNumber'),

        ]);
        session()->flash('message','เพิ่มเจ้าหน้าที่ถ่ายภาพใหม่ในระบบสำเร็จ'); //FLASH
        return view('alllists.index ',compact('carlists','roomtasks','cartasks','roomlists','drivers','cameramans'));
    }
}
