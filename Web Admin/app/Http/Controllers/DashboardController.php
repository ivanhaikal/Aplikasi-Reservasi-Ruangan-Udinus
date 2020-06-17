<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\Account;
use App\Time;
use App\Reservation;
class DashboardController extends Controller
{
    public function index(){
       
        return view('dashboards.index');
    }


    public function reservationview(){
     
        return view('dashboards.reservationview');
    }
    
    public function accountview(){
     
        return view('dashboards.accountview');
    }
    
    public function roomview(){
     
        return view('dashboards.roomview');
    }

    public function timeview(){
     
        return view('dashboards.timeview');
    }
}
