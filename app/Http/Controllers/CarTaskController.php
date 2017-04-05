<?php

namespace App\Http\Controllers;

use App\Car;
use App\Driver;
use App\RoomTask;
use Carbon\Carbon;
use App\Http\Requests\CarRequest;
use App\CarTask;

use Datatables;
use DB;
use User;
use Illuminate\Support\Facades\Auth;


class CarTaskController extends Controller
{
    public function index()
    {
        $cartasks = CarTask::all( );
        $carlists = Car::all();
        $drivers = Driver::all();
        return view ('cartasks.index', compact('carlists','cartasks','drivers'));
    }
    public function store(CarRequest $request)
    {
        $roomtasks = RoomTask::all();
        $cartasks = CarTask::with('user.roles','user.subroles','roles','subroles','alllists');
        $carlists = Car::all();
        $car =request("vehicle");
        $d1 =request('start_at');
        $d2 =request('finish_at');

        ///////between booked/////
        $db = DB::table('cars')
            ->where('vehicle', '=', $car)
            ->where('start_at', '<=', $d1)
            ->where('finish_at', '>=', $d2)->first();
        //////Before start_at to less than finish at////
        $db2 = DB::table('cars')
            ->where('vehicle', '=', $car)
            ->where('start_at', '>=', $d1)
            ->where('start_at', '<=', $d2)
            ->where('finish_at', '>=', $d2)->first();
        ////// Between booked to after or equal to finish_at
        $db3 = DB::table('cars')
            ->where('vehicle', '=', $car)
            ->where('start_at', '<=', $d1)
            ->where('finish_at', '>=', $d1)
            ->where('finish_at', '<=', $d2)->first();
        ////// Before start_at to after finish_at
        $db4 = DB::table('cars')
            ->where('vehicle', '=', $car)
            ->where('start_at', '>=', $d1)
            ->where('finish_at', '<=', $d2)
            ->first();

        if($db != null)
        {
            session()->flash('messagedanger','ห้องไม่ว่างในช่วเวลานี้ กรุณาเลือกช่วงเวลาใหม่1');
            return view('cartasks.create',compact('cartasks','roomtasks','carlists'));
        }
        else if ($db2 != null){
            session()->flash('messagedanger','ห้องไม่ว่างในช่วเวลานี้ กรุณาเลือกช่วงเวลาใหม2');
            return view('cartasks.create',compact('cartasks','roomtasks','carlists'));

        }
        else if ($db3 != null){
            session()->flash('messagedanger','ห้องไม่ว่างในช่วเวลานี้ กรุณาเลือกช่วงเวลาใหม่3');
            return view('cartasks.create',compact('cartasks','roomtasks','carlists'));
        }
        else if ($db4 != null){
            session()->flash('messagedanger','ห้องไม่ว่างในช่วเวลานี้ กรุณาเลือกช่วงเวลาใหม่4');
            return view('cartasks.create',compact('cartasks','roomtasks','carlists'));
        }
        else
        {
            $current = Carbon::parse(request('start_at'));
            $dt      = Carbon::parse(request('finish_at'));
            $hours = $current->diffInHours($dt);



            CarTask::create([
                'user_id'=>auth()->id(),
                'description'=>request('description'),
                'purpose'=>request('purpose'),
                'place'=>request('place'),
                'contactNumber'=>request('contactNumber'),
                'passenger'=>request('passenger'),
                'start_at'=>request('start_at'),
                'finish_at'=>request('finish_at'),
                'vehicle'=>request('vehicle'),
                'driver'=>request('driver'),
                'status'=>request('status'),
                'hours'=> $hours,

            ]);
            session()->flash('message','จองรถยนต์สำเร็จ โปรดรอการอณุมัติ'); //FLASH
            return redirect('users/booklist');

        }
    }

    public function GetCreateIndex()
    {
        $cartasks = CarTask::all( );
        $drivers = Driver::all();
        $carlists = Car::all();
        return view ('cartasks.create', compact('carlists','cartasks','drivers'));
    }
    public function ToggleStatus($id)
    {
        $cartasks = CarTask::findOrFail($id);
        $cartasks->status = !$cartasks->status;
        $cartasks->save();
        return redirect()->back();
    }

    public function getCarTask()
    {
        if(Auth::check() && Auth::user()->role == 7)//พนักงานขับรถ 7
        {
            $cartasks = CarTask::with('user.roles','user.subroles','roles','subroles','alllists');

            return Datatables::of($cartasks)
                ->addColumn('action', function ($cartasks) {

                    return '<a href="#" class="btn btn-xs btn-success"  data-toggle="modal" data-target="#driverModal' . $cartasks->id . '"> 
                   <i class="glyphicon glyphicon-exclamation-sign"></i> รายละเอียดการจอง </a>
                   
                    ';


                })
                ->make(true);
        }
        $cartasks = CarTask::with('user.roles','user.subroles','roles','subroles','alllists');
        return Datatables::of($cartasks)
            ->addColumn('action', function ($cartasks) {
                return '<a href="/cartasks/togglestatus/' . $cartasks->id . '" class="btn btn-xs btn-warning">
                      <i class="glyphicon glyphicon-refresh"></i> เปลี่ยนสถาณะ</a>

                      <a href="#" class="btn btn-xs btn-success"  data-toggle="modal" data-target="#carModal'.$cartasks->id.'">
                      <i class="glyphicon glyphicon-exclamation-sign"></i> รายละเอียดเพิ่มเติม</a>
     
                       <a href="/cartasks/destroy/' . $cartasks->id . '  " class="btn btn-xs btn-danger" >
                       <i class="glyphicon glyphicon-exclamation-sign"></i> ลบ </a> ';
            })
            ->make(true);
    }

    public function getbyId()
    {

        $cartasks = CarTask::with('user.roles','user.subroles','roles','subroles','alllists')->where('user_id', Auth::user()->id);

        return Datatables::of($cartasks)
            ->addColumn('action', function ($cartasks) {

                return '<a href="#" class="btn btn-xs btn-success"  data-toggle="modal" data-target="#carModal' . $cartasks->id . '"> 
                   <i class="glyphicon glyphicon-exclamation-sign"></i> รายละเอียดการจอง </a>
                   
                   <a href="/cartasks/destroy/' . $cartasks->id . '  " class="btn btn-xs btn-danger" >
                 <i class="glyphicon glyphicon-exclamation-sign"></i> ลบ </a> ';


            })
            ->make(true);

    }

    public function destroy($id)
    {
        $cartasks= CarTask::findOrFail($id);
        $cartasks->delete();

        return redirect()->back();
    }
}
