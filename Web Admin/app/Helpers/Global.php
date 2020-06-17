
<?php
use App\Room;
use App\Account;
use App\Reservation;
use App\Time;
use App\Aula;
use Illuminate\Http\Request;


function totalRoom(){
    return Room::count();
}

function totalAccount(){
    return Account::count();
}

function totalReservation(){
    return Reservation::count();
}

function totalTime(){
    return Time::count();
}





function daftarReservation(){
    // $reservation = Reservation::all();
    $reservation = DB::table('reservation')->join('account','account.id','=','reservation.accountId')->
            join('room','room.id','=','reservation.roomId')->
            join('time','time.id','=','reservation.timeId')->
            select('reservation.id','reservation.accountId','reservation.roomId','reservation.timeId', 
            'date', 'account.name_account', 'account.status','room.name','room.capacity','time.time','room.code',
            'reservation.created_at','account.email_account','account.nim_npp')->get();
      $reservation->map(function($r){
      $r->name_account;
      return $r;
    });

    $reservation = $reservation->sortByDesc('date')->take(5);
    return $reservation;
}

function daftarAccount(){
    $account = Account::all();
    $account->map(function($a){
      $a->name_account;
      return $a;
    });

    $account = $account->sortByDesc('name_account')->take(5);
    return $account;
}

function daftarReservationBaru(){
    // $reservation = Reservation::all();
    $reservation = DB::table('reservation')->join('account','account.id','=','reservation.accountId')->
            join('room','room.id','=','reservation.roomId')->
            join('time','time.id','=','reservation.timeId')->
            select('reservation.id','reservation.accountId','reservation.roomId','reservation.timeId', 'date', 'account.name_account', 'account.status','room.name','room.capacity','time.time','room.code','account.email_account')->paginate(10);
      $reservation->map(function($r){
      $r->name_account;
      return $r;
    });

    return $reservation;
}

function daftarAccountBaru(){
    $account = Account::paginate(10);
    $account->map(function($a){
      $a->name_account;
      return $a;
    });

    return $account;
}


function daftarRoom(){
    $room = Room::paginate(10);
    $room->map(function($ro){
      $ro->name;
      return $ro;
    });

    return $room;
}

function daftarTime(){
    $time = Time::paginate(10);
    $time->map(function($t){
      $t->time;
      return $t;
    });

    return $time;
}
?>