<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ReservationController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('cari')){
            $data_reservation = DB::table('reservation')->join('account','account.id','=','reservation.accountId')->
            join('room','room.id','=','reservation.roomId')->
            join('time','time.id','=','reservation.timeId')->
            select('reservation.id','reservation.accountId','reservation.roomId','reservation.timeId', 'date', 'account.name_account', 'account.status','room.name','room.capacity','time.time','room.code','reservation.created_at','account.email_account')->where('name_account','LIKE','%'.$request->cari.'%')->paginate(10);
          }else{
            $data_reservation = DB::table('reservation')->join('account','account.id','=','reservation.accountId')->
            join('room','room.id','=','reservation.roomId')->
            join('time','time.id','=','reservation.timeId')->
            select('reservation.id','reservation.accountId','reservation.roomId','reservation.timeId', 'date', 'account.name_account', 'account.status','room.name','room.capacity','time.time','room.code','reservation.created_at','account.email_account')->paginate(10);
          } 
        return view('reservation.index', ['data_reservation' => $data_reservation]);
    }

    public function create(Request $request)
    {
      
        $this->validate($request,[
            'roomId'=>'required',
            'accountId'=>'required',
            'date'=>'required',
            'timeId'=>'required'
          ]);
          
        $reservation = \App\Reservation::create($request->all());
        return redirect('/reservation')->with('sukses', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $reservation = \App\Reservation::find($id);
        return view('reservation/edit', ['reservation'=>$reservation]);
    }

    public function update(Request $request, $id)
    {
        $reservation = \App\Reservation::find($id);
        $reservation->update($request->all());
        return redirect('/reservation')->with('sukses', 'Data berhasil diupdate');
    }

    public function delete($id)
    {
        $reservation = \App\Reservation::find($id);
        $reservation->delete();
        return redirect('/reservation')->with('sukses', 'Data berhasil di hapus berhasil dihapus');
    }

    
}
