<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use Illuminate\Http\Request;
use App\Room;
use App;
use App\Devices;
use Illuminate\Support\Facades\Auth;
class RoomListController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['only' => [
            'store'
        ]]);
    }
    public function store(RoomRequest $request)
        {
            session()->flash('message','เพิ่มห้องสำเร็จ'); // FLASH

            $roomlist = Room::create($request->all());
            $deviceIds = $request->input('devices');
            $roomlist->devices()->attach($deviceIds);
            return redirect('/alllists');

        }

}
