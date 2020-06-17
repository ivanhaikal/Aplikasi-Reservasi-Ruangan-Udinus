<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AulaController extends Controller
{
    public function index(Request $request){
        if($request->has('cari')){
            $data_aula = \App\Room::where('name','LIKE','%'.$request->cari.'%')->where('type','LIKE','hall')->paginate(10);
        }
        else{
            $data_aula = \App\Room::where('type','LIKE','hall')->paginate(10);
        }
        return view('aula.index',['data_aula' => $data_aula]);
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
        $aula = \App\Room::create($request->all());
        if($request->hasfile('image')){
            $request->file('image')->move('room_image/',$request->file('image')->getClientOriginalName());
            $aula->image = $request->file('image')->getClientOriginalName();
            $aula->save(); 
        }
        return redirect('/aula')->with('sukses','Data berhasil ditambah');
    }

    public function edit($id){
        $aula = \App\Room::find($id);
        return view('aula/edit',['aula'=>$aula]);
    }

    public function update(Request $request,$id){
        $aula = \App\Room::find($id);
        $aula->update($request->all());
        if($request->hasfile('image')){
            $request->file('image')->move('room_image/',$request->file('image')->getClientOriginalName());
            $aula->image = $request->file('image')->getClientOriginalName();
            $aula->save(); 
        } 

        return redirect('/aula')->with('sukses','Data berhasil diupdate');
    }

    public function delete($id){
        $aula = \App\Room::find($id);
        $aula->delete();
        return redirect ('/aula')->with('sukses','Data berhasil dihapus');
    }

    public function preview($id){
        $aula = \App\Room::find($id);
        return view('aula.preview',['aula'=>$aula]);
    }
}
