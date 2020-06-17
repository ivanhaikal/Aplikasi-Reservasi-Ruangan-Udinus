<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TimeController extends Controller
{
    public function index(Request $request){
        if($request->has('cari')){
            $data_time = \App\Time::where('time','LIKE','%'.$request->cari.'%')->paginate(10);
        }else{
            $data_time = \App\Time::paginate(10);
        }
        return view('time.index',['data_time' => $data_time]);
      }
    
      public function create(Request $request){

        $this->validate($request,[
          'time'=>'required'
          ]);

        $data_time = \App\Time::create($request->all());
        return redirect('/time')->with('sukses','Data berhasil ditambah');;
      }
   
      public function edit($id)
    {
        $time = \App\Time::find($id);
        return view('time/edit', ['time'=>$time]);
    }

    public function update(Request $request, $id)
    {
        $time = \App\Time::find($id);
        $time->update($request->all());
        return redirect('/time')->with('sukses', 'Data berhasil diupdate');
    }

      public function delete($id){
        $time = \App\Time::find($id);
        $time->delete();
        return redirect ('/time')->with('sukses','Data berhasil dihapus');
    }
    
}
