<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CarTask;
use App\RoomTask;
use App\CameraTask;


class CalendarController extends Controller
{
    public function getRoomArraySQL()
    {
        $roomtasks = RoomTask::with('user.roles','user.subroles','roomlist','roles')->get();
//        return response()->json([
//            'name' => 'Abigail'
//        ]);
        return response()->json($roomtasks);
    }

    public function getCarArraySQL()
    {
        $cartasks = CarTask::with('user.roles','user.subroles','roles','subroles','alllists')->get();
        return response()->json($cartasks);

    }

    public function getCameraArraySQL()
    {
        $cameratasks = CameraTask::with('user.roles','user.subroles','roles','subroles')->get();
        return response()->json($cameratasks);

    }
}
