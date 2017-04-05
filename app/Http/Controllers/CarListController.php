<?php

namespace App\Http\Controllers;

use App\CarTask;
use App\Devices;
use App\Http\Requests\RoomRequest;
use App\Room;
use App\RoomTask;
use Illuminate\Http\Request;
use App\Car;
class CarListController extends Controller
{
    public function store(RoomRequest $request)
    {
        $carlists = Car::all();
        $roomtasks = RoomTask::all();
        $cartasks = CarTask::all();
        $roomlists = Room::all();


        Car::create([

            'description'=>request('description'),
            'capacity'=>request('capacity'),
            'type'=>request('type'),
            'license'=>request('license'),
            'model'=>request('model'),
            'brand'=>request('brand'),
            'image'=>request('image')

        ]);
        session()->flash('message','เพิ่มรถยนต์ใหม่ในระบบสำเร็จ'); //FLASH
        return view('alllists.index ',compact('carlists','roomtasks','cartasks','roomlists'));
    }

}
