<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index(Request $request){
        if($request->has('cari')){
            $data_account = \App\Account::where('nim_npp','LIKE','%'.$request->cari.'%')->paginate(10);
        }
        else{
            $data_account = \App\Account::paginate(10);
        }
        return view('account.index',['data_account' => $data_account]);
    }

    public function create(Request $request){

        // dd($request->all());
        $this->validate($request,[
            'nim_npp' =>'required',
            'name_account' =>'required|max:30',
            'gender' =>'required',
            'dob' =>'required',
            'phone' =>'required|max:15',
            'email_account' =>'required',
            'status' =>'required',
            'image_account' =>'mimes:jpeg,jpg,png|max:10000',
            'password' => 'required'
        ]);
        $account = \App\Account::create($request->all());
        if($request->hasfile('image_account')){
            $request->file('image_account')->move('account_image/',$request->file('image_account')->getClientOriginalName());
            $account->image_account = $request->file('image_account')->getClientOriginalName();
            $account->save(); 
        }
        return redirect('/account')->with('sukses','Data berhasil ditambah');
    }

    public function edit($id){
        $account = \App\Account::find($id);
        return view('account/edit',['account'=>$account]);
    }

    public function update(Request $request,$id){
        $account = \App\Account::find($id);
        $account->update($request->all());
        if($request->hasfile('image_account')){
            $request->file('image_account')->move('account_image/',$request->file('image_account')->getClientOriginalName());
            $account->image_account = $request->file('image_account')->getClientOriginalName();
            $account->save(); 
        }  
        return redirect('/account')->with('sukses','Data berhasil diupdate');
    }

    public function delete($id){
        $account = \App\Account::find($id);
        $account->delete();
        return redirect ('/account')->with('sukses','Data berhasil dihapus');
    }

    public function profile($id){
        $account = \App\Account::find($id);
        return view('account.profile',['account'=>$account]);
    }

}
