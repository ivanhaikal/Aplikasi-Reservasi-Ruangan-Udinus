<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class KelasController extends Controller
{
    public function index(Request $request){
        if($request->has('cari')){
            $data_kelas = \App\Room::where('name','LIKE','%'.$request->cari.'%')->where('type','LIKE','class')->paginate(10);
        }
        else{
            $data_kelas = \App\Room::where('type','LIKE','class')->paginate(10);
        }
        return view('kelas.index',['data_kelas' => $data_kelas]);
    }
    public function create(Request $request){

        // dd($request->all());
        $this->validate($request,[
            'code' =>'required|max:7',
            'name' =>'required|max:20',
            'capacity' =>'required|max:4',
            'image' =>'mimes:jpeg,jpg,png,gif|max:10000',
            'type' => 'required'
        ]);
        $kelas = \App\Room::create($request->all());
        if($request->hasfile('image')){
            $request->file('image')->move('room_image/',$request->file('image')->getClientOriginalName());
            $kelas->image = $request->file('image')->getClientOriginalName();
            $kelas->save(); 
        }
        return redirect('/kelas')->with('sukses','Data berhasil ditambah');
    }

    public function edit($id){
        $kelas = \App\Room::find($id);
        return view('kelas/edit',['kelas'=>$kelas]);
    }

    public function update(Request $request,$id){
        $kelas = \App\Room::find($id);
        $kelas->update($request->all());
        if($request->hasfile('image')){
            $request->file('image')->move('room_image/',$request->file('image')->getClientOriginalName());
            $kelas->image = $request->file('image')->getClientOriginalName();
            $kelas->save(); 
        } 

        return redirect('/kelas')->with('sukses','Data berhasil diupdate');
    }

    public function delete($id){
        $kelas = \App\Room::find($id);
        $kelas->delete();
        return redirect ('/kelas')->with('sukses','Data berhasil dihapus');
    }

    public function preview($id){
        $kelas = \App\Room::find($id);
        return view('kelas.preview',['kelas'=>$kelas]);
    }
}
