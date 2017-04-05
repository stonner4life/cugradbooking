<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CameraTask;
use App\CameraMan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Yajra\Datatables\Facades\Datatables;

class CameraTaskController extends Controller
{
    public function index()
    {
        $cameratasks = CameraTask::all();
        return view('cameratasks.index',compact('cameratasks'));
    }

    public function GetCreateIndex()
    {
        $cameramans = CameraMan::all();
        return view ('cameratasks.create',compact('cameramans'));
    }
    public function GetAllTask(){

        $cameratasks = CameraTask::with('user.roles','user.subroles','roles','subroles')->get();

        return Datatables::of($cameratasks)
            ->addColumn('action', function ($cameratasks) {

                return '<a href="/cameratask/togglestatus/' . $cameratasks->id . '" class="btn btn-xs btn-warning">
                <i class="glyphicon glyphicon-refresh"></i> เปลี่ยนสถาณะ</a>

                 <a href="#" class="btn btn-xs btn-success"  data-toggle="modal" data-target="#CameraTaskModal' . $cameratasks->id . '">
                 <i class="glyphicon glyphicon-exclamation-sign"></i> รายละเอียดเพิ่มเติม</a>
                 
                  <a href="/cameratask/destroy/' . $cameratasks->id . '  " class="btn btn-xs btn-danger" >
                 <i class="glyphicon glyphicon-exclamation-sign"></i> ลบ </a> ';
            })
            ->make(true);
    }

    public function GetById()
    {
        $cameratasks = CameraTask::with('user.roles','user.subroles','roles','subroles')->where('user_id', Auth::user()->id);

        return Datatables::of($cameratasks)
            ->addColumn('action', function ($cameratasks) {

                return '<a href="#" class="btn btn-xs btn-success"  data-toggle="modal" data-target="#CameraTaskModal' . $cameratasks->id . '"> 
                   <i class="glyphicon glyphicon-exclamation-sign"></i> รายละเอียดการจอง </a>
                   
                   <a href="/cameratask/destroy/' . $cameratasks->id . '  " class="btn btn-xs btn-danger" >
                 <i class="glyphicon glyphicon-exclamation-sign"></i> ลบ </a> ';


            })
            ->make(true);
    }



    public function store(){

        $current = Carbon::parse(request('start_at'));
        $dt      = Carbon::parse(request('finish_at'));
        $cameraman = request("cameraMan");
        $hours = $current->diffInHours($dt);

        ///////between booked/////
        $db = DB::table('camera_tasks')
            ->where('cameraMan', '=', $cameraman)
            ->where('start_at', '<=', $current)
            ->where('finish_at', '>=', $dt)->first();
        //////Before start_at to less than finish at////
        $db2 = DB::table('camera_tasks')
            ->where('cameraMan', '=', $cameraman)
            ->where('start_at', '>=', $current)
            ->where('start_at', '<=', $dt)
            ->where('finish_at', '>=', $dt)->first();
        ////// Between booked to after or equal to finish_at
        $db3 = DB::table('camera_tasks')
            ->where('cameraMan', '=', $cameraman)
            ->where('start_at', '<=', $current)
            ->where('finish_at', '>=', $dt)
            ->where('finish_at', '<=', $dt)->first();
        ////// Before start_at to after finish_at
        $db4 = DB::table('camera_tasks')
            ->where('cameraMan', '=', $cameraman)
            ->where('start_at', '>=', $current)
            ->where('finish_at', '<=', $dt)
            ->first();
        if($db != null)
        {
            session()->flash('messagedanger','ห้องไม่ว่างในช่วเวลานี้ กรุณาเลือกช่วงเวลาใหม่1');
            return view ('cameratasks.create');
        }
        else if ($db2 != null){
            session()->flash('messagedanger','ห้องไม่ว่างในช่วเวลานี้ กรุณาเลือกช่วงเวลาใหม2');
            return view ('cameratasks.create');

        }
        else if ($db3 != null){
            session()->flash('messagedanger','ห้องไม่ว่างในช่วเวลานี้ กรุณาเลือกช่วงเวลาใหม่3');
            return view ('cameratasks.create');
        }
        else if ($db4 != null){
            session()->flash('messagedanger','ห้องไม่ว่างในช่วเวลานี้ กรุณาเลือกช่วงเวลาใหม่4');
            return view ('cameratasks.create');
        }
        else
        {
            $current = Carbon::parse(request('start_at'));
            $dt      = Carbon::parse(request('finish_at'));
            $hours = $current->diffInHours($dt);



            CameraTask::create([
                'user_id'=>auth()->id(),
                'contactNumber'=>request('contactNumber'),
                'description' =>request('description'),
                'cameraMan'=>request('cameraMan'),
                'place'=>request('place'),
                'start_at'=>request('start_at'),
                'finish_at'=>request('finish_at'),
                'hours'=> $hours,

            ]);

            session()->flash('message','จองพนักงานถ่านรูปสำเร็จ โปรดรอการอณุมัติ'); //FLASH
            return redirect('users/booklist');

        }


    }

    public function destroy($id)
    {
        $cameratasks = CameraTask::findOrFail($id);
        $cameratasks->delete();

        return redirect()->back();
    }

    public function ToggleStatus($id)
    {
        $cameratasks = CameraTask::findOrFail($id);
        $cameratasks->status = !$cameratasks->status;
        $cameratasks->save();
        return redirect()->back();
    }

}
