<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Devices;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //Filter USER to correct View

        if( Auth::check() && Auth::user()->role== 1 )  //ADMIN
        {
            $devices = Devices::pluck('name','id');
            return view('admin.home', compact('roomlists', 'devices','carlists','roomtasks'));
        }
        else if (Auth::check() && Auth::user()->role >1 && Auth::user()->role <=6) //InGradUser
        {
            return view('home', compact('roomlists', 'devices','carlists','roomtasks'));
        }
        else if (Auth::check() && Auth::user()->role == 7) //Driver
        {
            return view('driverhome', compact('roomlists', 'devices','carlists','roomtasks'));
        }
        else if (Auth::check() && Auth::user()->role == 9) //Keeper
        {
            return view('keeperhome', compact('roomlists', 'devices','carlists','roomtasks'));
        }

        else if (Auth::check() && Auth::user()->role == 10) // สหศึกษา
        {
            return view('coedhome', compact('roomlists', 'devices','carlists','roomtasks'));
        }

    }

    public function AdminIndex()
    {
        //ONLY ADMIN ALLOW HERE
        if(Auth::check() && Auth::user()->role== 1)
        {
            $devices = Devices::pluck('name','id');
            return view('admin.home',compact('devices'));
        }
       else
       {
           session()->flash('messagedanger','สำหรับผู้ดูแลระบบเท่านั้น !!!');
           return view('home');
       }
    }

}
