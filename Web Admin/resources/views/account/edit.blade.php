@extends('layouts.master')


@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="cool-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Edit Account</h3>
                        </div>
                        <div class="panel-body">
                            <form action="/account/{{$account->id}}/update" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="inputnimnpp">Nim/Npp</label>
                                    <input name="nim_npp" type="text" class="form-control" id="inputnimnpp1"
                                        placeholder="inputkan nim/npp" value="{{$account->nim_npp}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputnama">Nama</label>
                                    <input name="name_account" type="text" class="form-control" id="inputnama1"
                                        placeholder="inputkan nama" value="{{$account->name_account}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputstatus">Jenis Kelamin</label><br>
                                    <select name="gender" class="form-control">
                                        <option value="L" @if($account->type == 'L') selected @endif>Laki-Laki</option>
                                        <option value="P" @if($account->type == 'P') selected @endif>Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputtanggallahir">Tanggal Lahir</label>
                                    <input name="dob" type="date" class="form-control" id="inputtanggallahir1"
                                        placeholder="inputkan tanggal lahir" value="{{$account->dob}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputtnotelp">No Telp</label>
                                    <input name="phone" type="text" class="form-control" id="inputtnotelp1"
                                        placeholder="inputkan nomor telepon" value="{{$account->phone}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputemail">Email</label>
                                    <input name="email_account" type="email" class="form-control" id="inputemail"
                                        placeholder="inputkan email" value="{{$account->email_account}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputstatus">Status</label><br>
                                    <select name="status" class="form-control">
                                        <option value="mahasiswa" @if($account->type == 'mahasiswa') selected @endif>Mahasiswa</option>
                                        <option value="dosen" @if($account->type == 'dosen') selected @endif>Dosen</option>
                                        <option value="karyawan" @if($account->type == 'karyawan') selected @endif>Karyawan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputimage">Image</label>
                                    <input type="file" name="image_account" class="form-control" value="{{$account->image_account}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputpassword">Password</label>
                                    <input name="password" type="password" class="form-control" id="inputpassword1"
                                        placeholder="inputkan password" value="{{$account->password}}">
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-warning">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
