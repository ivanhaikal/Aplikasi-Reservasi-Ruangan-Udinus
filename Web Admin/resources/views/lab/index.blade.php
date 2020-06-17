@extends('layouts.master')

@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="cool-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><b><i class="lnr lnr-keyboard"></i> LAB</b></h3>
                            <i>kotak pencarian untuk mencari nama lab</i>
                            <div class="right">
                                <button type="button" data-toggle="modal" data-target="#exampleModal">
                                <br><br><i class="lnr lnr-plus-circle" style="padding:5px;"></i>
                                <b>TAMBAH LAB</b></button>
                                </div>
                        </div><br>
                        <div class="panel-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Kode Lab</th>
                                        <th>Nama Lab</th>
                                        <th>Kapasitas</th>
                                        <th>Image</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_lab as $room)
                                    <tr>
                                        <td>{{$room->id}}</td>
                                        <td><a href="/lab/{{$room->id}}/preview">{{$room->code}}</a></td>
                                        <td>{{$room->name}}</td>
                                        <td>{{$room->capacity}}</td>
                                        <td><img width="50px" height="50px" src="{{$room->getImage()}}"></td>
                                        <td><a href="/lab/{{$room->id}}/edit" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="#" class="btn btn-danger btn-sm delete"
                                                room-id="{{$room->id}}">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$data_lab->links()}}
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
                <h5 class="modal-title" id="exampleModalLabel"><i class="lnr lnr-keyboard"><b>Lab</b></i></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/lab/create" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group{{$errors->has('type') ? ' has-error': ''}}">
                        <input name="type" type="hidden" class="form-control" id="inputtype" value="lab"
                            readonly>
                        @if($errors->has('type'))
                        <span class="help-block">{{$errors->first('type')}}</span>
                        @endif
                    </div>
                    <div class="form-group{{$errors->has('code') ? ' has-error' : ''}}">
                        <label for="inputkodekelas">Kode Lab</label>
                        <input name="code" type="text" class="form-control" id="inputkodekelas1"
                            placeholder="inputkan kode lab" value="{{old('code')}}">
                        @if($errors->has('code'))
                        <span class="help-block">{{$errors->first('code')}}</span>
                        @endif
                    </div>
                    <div class="form-group{{$errors->has('name') ? ' has-error' : ''}}">
                        <label for="inputnamakelas">Nama Lab</label>
                        <input name="name" type="text" class="form-control" id="inputnamakelas1"
                            placeholder="inputkan nama lab" value="{{old('name')}}">
                        @if($errors->has('name'))
                        <span class="help-block">{{$errors->first('name')}}</span>
                        @endif
                    </div>
                    <div class="form-group{{$errors->has('capacity') ? ' has-error' : ''}}">
                        <label for="inputkapasitas">Kapasitas</label>
                        <input name="capacity" type="number" class="form-control" id="inputkapasitas1"
                            placeholder="inputkan kapasitas lab" value="{{old('capacity')}}">
                        @if($errors->has('capacity'))
                        <span class="help-block">{{$errors->first('capacity')}}</span>
                        @endif
                    </div>
                    <div class="form-group{{$errors->has('image') ? ' has-error' : ''}}">
                        <label for="inputgambar">Image</label>
                        <input type="file" name="image" class="form-control">
                        @if($errors->has('image'))
                        <span class="help-block">{{$errors->first('image')}}</span>
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
        var room_id = $(this).attr('room-id');
        swal({
                title: "Yakin?",
                text: "Mau hapus data lab ini ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                console.log(willDelete);
                if (willDelete) {
                   window.location = "/lab/"+room_id+"/delete";
                } 
            });
    });
</script>

@endsection
