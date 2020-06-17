@extends('layouts.master')

@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="cool-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><b><i class="lnr lnr-users"></i> ACCOUNT</b></h3>
                            <i>kotak pencarian untuk mencari nim/npp</i>
                            <div class="right">
                                <button type="button" data-toggle="modal" data-target="#exampleModal">
                                <br><br><i class="lnr lnr-plus-circle" style="padding:5px;"></i>
                                <b>TAMBAH ACCOUNT</b></button>
                                </div>
                        </div><br>
                        <div class="panel-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nim/Npp</th>
                                        <th>Nama</th>
                                        <th>Gender</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_account as $account)
                                    <tr>
                                        <td>{{$account->id}}</td>
                                        <td><a href="/account/{{$account->id}}/profile">{{$account->nim_npp}}</a></td>
                                        <td>{{$account->name_account}}</td>
                                        <td>{{$account->gender}}</td>
                                        <td>{{$account->dob}}</td>
                                        <td>{{$account->email_account}}</td>
                                        <td>{{$account->status}}</td>
                                        <td><a href="/account/{{$account->id}}/edit" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="#" class="btn btn-danger btn-sm delete"
                                            account-id="{{$account->id}}">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$data_account->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="lnr lnr-users"><b>Account</b></i></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/account/create" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group{{$errors->has('nim_npp') ? ' has-error' : ''}}">
                        <label for="inputnimnpp">Nim/Npp</label>
                        <input name="nim_npp" type="text" class="form-control" id="inputnimnpp1"
                            placeholder="inputkan nim/npp" value="{{old('nim_npp')}}">
                        @if($errors->has('nim_npp'))
                        <span class="help-block">{{$errors->first('nim_npp')}}</span>
                        @endif
                    </div>
                    <div class="form-group{{$errors->has('name_account') ? ' has-error' : ''}}">
                        <label for="inputnama">Nama</label>
                        <input name="name_account" type="text" class="form-control" id="inputnama1"
                            placeholder="inputkan nama" value="{{old('name_account')}}">
                        @if($errors->has('name_account'))
                        <span class="help-block">{{$errors->first('name_account')}}</span>
                        @endif
                    </div>
                    <div class="form-group{{$errors->has('gender') ? ' has-error': ''}}">
                        <label for="inputstatus">Jenis Kelamin</label><br>
                        <select name="gender" class="form-control">
                            <option value="L"{{(old('gender') == 'L') ? ' selected' : ''}}>Laki-Laki</option>
                            <option value="P"{{(old('gender') == 'P') ? ' selected' : ''}}>Perempuan</option>
                        </select>
                        @if($errors->has('gender'))
                        <span class="help-block">{{$errors->first('gender')}}</span>
                        @endif
                    </div>
                    <div class="form-group{{$errors->has('dob') ? ' has-error' : ''}}">
                        <label for="inputtanggallahir">Tanggal Lahir</label>
                        <input name="dob" type="date" class="form-control" id="inputtanggallahir1"
                            placeholder="inputkan tanggal lahir" value="{{old('dob')}}">
                        @if($errors->has('dob'))
                        <span class="help-block">{{$errors->first('dob')}}</span>
                        @endif
                    </div>
                    <div class="form-group{{$errors->has('phone') ? ' has-error' : ''}}">
                        <label for="inputtnotelp">No Telp</label>
                        <input name="phone" type="text" class="form-control" id="inputtnotelp1"
                            placeholder="inputkan nomor telepon" value="{{old('phone')}}">
                        @if($errors->has('phone'))
                        <span class="help-block">{{$errors->first('phone')}}</span>
                        @endif
                    </div>
                    <div class="form-group{{$errors->has('email_account') ? ' has-error' : ''}}">
                        <label for="inputemail">Email</label>
                        <input name="email_account" type="email" class="form-control" id="inputemail"
                            placeholder="inputkan email" value="{{old('email_account')}}">
                        @if($errors->has('email_account'))
                        <span class="help-block">{{$errors->first('email_account')}}</span>
                        @endif
                    </div>
                    <div class="form-group{{$errors->has('status') ? ' has-error': ''}}">
                        <label for="inputstatus">Status</label><br>
                        <select name="status" class="form-control">
                            <option value="mahasiswa"{{(old('status') == 'mahasiswa') ? ' selected' : ''}}>Mahasiswa</option>
                            <option value="dosen"{{(old('status') == 'dosen') ? ' selected' : ''}}>Dosen</option>
                            <option value="karyawan"{{(old('status') == 'karyawan') ? ' selected' : ''}}>Karyawan</option>
                        </select>
                        @if($errors->has('status'))
                        <span class="help-block">{{$errors->first('status')}}</span>
                        @endif
                    </div>
                    <div class="form-group{{$errors->has('image_account') ? ' has-error' : ''}}">
                        <label for="inputgambar">Image</label>
                        <input type="file" name="image" class="form-control">
                        @if($errors->has('image_account'))
                        <span class="help-block">{{$errors->first('image_account')}}</span>
                        @endif
                    </div>
                    <div class="form-group{{$errors->has('password') ? ' has-error' : ''}}">
                        <label for="inputpassword">Password</label>
                        <input name="password" type="password" class="form-control" id="inputnama1"
                            placeholder="inputkan password" value="{{old('password')}}">
                        @if($errors->has('password'))
                        <span class="help-block">{{$errors->first('password')}}</span>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@section('footer')
<script>
    $('.delete').click(function() {
        var account_id = $(this).attr('account-id');
        swal({
                title: "Yakin?",
                text: "Mau hapus data pengguna ini ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                console.log(willDelete);
                if (willDelete) {
                   window.location = "/account/"+account_id+"/delete";
                } 
            });
    });
</script>

@endsection
