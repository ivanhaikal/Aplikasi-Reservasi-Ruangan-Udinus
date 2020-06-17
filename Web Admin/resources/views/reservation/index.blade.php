@extends('layouts.master')

@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="cool-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="lnr lnr-book"></i><b> RESERVATION</b></h3>
                            <i>Kotak pencarian untuk name account</i>
                            <div class="right">
                            <button type="button" data-toggle="modal" data-target="#exampleModal">
                            <i class="lnr lnr-plus-circle" style="padding:5px;"></i>
                          <b>TAMBAH RESERVATON</b></button>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama Akun</th>
                                        <th>Status</th>
                                        <th>Kode Ruang</th>
                                        <th>Nama Ruang</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Jam Pinjam</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($data_reservation as $account)
                                    <tr>
                                        <td>{{$account->name_account}}</td>
                                        <td>{{$account->status}}</td>
                                        <td>{{$account->code}}</td>
                                        <td>{{$account->name}}</td>
                                        <td>{{$account->date}}</td>
                                        <td>{{$account->time}}</td>
                                        <td><a href="/reservation/{{$account->id}}/edit" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="#" class="btn btn-danger btn-sm delete"
                                                reservation-id="{{$account->id}}">Delete</a>
                                        </td>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$data_reservation->links()}}
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
                <h5 class="modal-title" id="exampleModalLabel"><i class="lnr lnr-book"><b>Reservation</b></i></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="/reservation/create" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group{{$errors->has('accountId') ? ' has-error': ''}}">
                        <label for="inputaccountid">ACCOUNT ID</label>
                        <input name="accountId" type="number" class="form-control" id="inputaccountid1"
                            placeholder="Masukkan Account ID" value="{{old('accountId')}}">
                        @if($errors->has('accountId'))
                        <span class="help-block">{{$errors->first('accountId')}}</span>
                        @endif
                    </div>
                    <div class="form-group{{$errors->has('roomId') ? ' has-error': ''}}">
                        <label for="inputroomid">ROOM ID</label>
                        <input name="roomId" type="number" class="form-control" id="inputroomid1"
                            placeholder="Masukkan Room Id" value="{{old('roomId')}}">
                        @if($errors->has('roomId'))
                        <span class="help-block">{{$errors->first('roomId')}}</span>
                        @endif
                    </div>
                    <div class="form-group{{$errors->has('date') ? ' has-error': ''}}">
                        <label for="inputdate">TANGGAL</label>
                        <input name="date" type="date" class="form-control" id="inputdate1"
                            placeholder="Masukkan tanggal" value="{{old('date')}}">
                        @if($errors->has('date'))
                        <span class="help-block">{{$errors->first('date')}}</span>
                        @endif
                    </div>
                    <div class="form-group{{$errors->has('timeId') ? ' has-error': ''}}">
                        <label for="inputtime">TIME ID</label>
                        <input name="timeId" type="number" class="form-control" id="inputtime"
                            placeholder="Masukkan Time" value="{{old('timeId')}}">
                        @if($errors->has('timeId'))
                        <span class="help-block">{{$errors->first('timeId')}}</span>
                        @endif
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection

@section('footer')
<script>
    $('.delete').click(function() {
        var reservation_id = $(this).attr('reservation-id');
        swal({
                title: "Yakin?",
                text: "Mau hapus data reservation ini ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                console.log(willDelete);
                if (willDelete) {
                   window.location = "/reservation/"+reservation_id+"/delete";
                } 
            });
    });
</script>

@endsection
