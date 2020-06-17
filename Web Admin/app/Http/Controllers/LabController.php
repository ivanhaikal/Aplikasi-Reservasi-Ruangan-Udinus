<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LabController extends Controller
{
    public function index(Request $request){
        if($request->has('cari')){
            $data_lab = \App\Room::where('name','LIKE','%'.$request->cari.'%')->where('type','LIKE','lab')->paginate(10);
        }
        else{
            $data_lab = \App\Room::where('type','LIKE','lab')->paginate(10);
        }
        return view('lab.index',['data_lab' => $data_lab]);
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
        $lab = \App\Room::create($request->all());
        if($request->hasfile('image')){
            $request->file('image')->move('room_image/',$request->file('image')->getClientOriginalName());
            $lab->image = $request->file('image')->getClientOriginalName();
            $lab->save(); 
        }
        return redirect('/lab')->with('sukses','Data berhasil ditambah');
    }

    public function edit($id){
        $lab = \App\Room::find($id);
        return view('lab/edit',['lab'=>$lab]);
    }

    public function update(Request $request,$id){
        $lab = \App\Room::find($id);
        $lab->update($request->all());
        if($request->hasfile('image')){
            $request->file('image')->move('room_image/',$request->file('image')->getClientOriginalName());
            $lab->image = $request->file('image')->getClientOriginalName();
            $lab->save(); 
        } 

        return redirect('/lab')->with('sukses','Data berhasil diupdate');
    }

    public function delete($id){
        $lab = \App\Room::find($id);
        $lab->delete();
        return redirect ('/lab')->with('sukses','Data berhasil dihapus');
    }

    public function preview($id){
        $lab = \App\Room::find($id);
        return view('lab.preview',['lab'=>$lab]);
    }
}
