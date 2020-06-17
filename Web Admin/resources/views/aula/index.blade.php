@extends('layouts.master')

@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="cool-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><b><i class="lnr lnr-apartment"></i> AULA</b></h3>
                            <i>kotak pencarian untuk mencari nama aula</i>
                            <div class="right">
                                <button type="button" data-toggle="modal" data-target="#exampleModal">
                                <br><br><i class="lnr lnr-plus-circle" style="padding:5px;"></i>
                                <b>TAMBAH AULA</b></button>
                                </div>
                        </div><br>
                        <div class="panel-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>KODE AULA</th>
                                        <th>NAMA AULA</th>
                                        <th>KAPASITAS</th>
                                        <th>IMAGE</th>
                                        {{-- <th>Image 2</th>
                                        <th>Image 3</th> --}}
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_aula as $room)
                                    <tr>
                                        <td>{{$room->id}}</td>
                                        <td><a href="/aula/{{$room->id}}/preview">{{$room->code}}</a></td>
                                        <td>{{$room->name}}</td>
                                        <td>{{$room->capacity}}</td>
                                        <td><img width="50px" height="50px" src="{{$room->getImage()}}"></td>
                                        {{-- <td><img width="50px" height="50px" src="{{url('/images/'.$room->image_2)}}"></td>
                                        <td><img width="50px" height="50px" src="{{url('/images/'.$room->image_3)}}"></td> --}}
                                        <td><a href="/aula/{{$room->id}}/edit" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="#" class="btn btn-danger btn-sm delete"
                                                aula-id="{{$room->id}}">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$data_aula->links()}}
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
                <h5 class="modal-title" id="exampleModalLabel"><i class="lnr lnr-apartment"><b>Aula</b></i></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/aula/create" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group{{$errors->has('type') ? ' has-error': ''}}">
                        <input name="type" type="hidden" class="form-control" id="inputtype" value="hall"
                            readonly>
                        @if($errors->has('type'))
                        <span class="help-block">{{$errors->first('type')}}</span>
                        @endif
                    </div>
                    <div class="form-group{{$errors->has('code') ? ' has-error' : ''}}">
                        <label for="inputkodeaula">Kode Aula</label>
                        <input name="code" type="text" class="form-control" id="inputkodeaula1"
                            placeholder="inputkan kode aula" value="{{old('code')}}">
                        @if($errors->has('code'))
                        <span class="help-block">{{$errors->first('code')}}</span>
                        @endif
                    </div>
                    <div class="form-group{{$errors->has('name') ? ' has-error' : ''}}">
                        <label for="inputnamaaula">Nama Aula</label>
                        <input name="name" type="text" class="form-control" id="inputnamaaula1"
                            placeholder="inputkan nama aula" value="{{old('name')}}">
                        @if($errors->has('name'))
                        <span class="help-block">{{$errors->first('name')}}</span>
                        @endif
                    </div>
                    <div class="form-group{{$errors->has('capacity') ? ' has-error' : ''}}">
                        <label for="inputkapasitas">Kapasitas</label>
                        <input name="capacity" type="number" class="form-control" id="inputkapasitas1"
                            placeholder="inputkan kapasitas aula" value="{{old('capacity')}}">
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
                    {{-- <div class="form-group{{$errors->has('image_2') ? ' has-error' : ''}}">
                        <label for="inputgambar2">Image 2</label>
                        <input type="file" name="image_2" class="form-control">
                        @if($errors->has('image_2'))
                        <span class="help-block">{{$errors->first('image_2')}}</span>
                        @endif
                    </div>
                    <div class="form-group{{$errors->has('image_3') ? ' has-error' : ''}}">
                        <label for="inputgambar3">Image 3</label>
                        <input type="file" name="image_3" class="form-control">
                        @if($errors->has('image_3'))
                        <span class="help-block">{{$errors->first('image_3')}}</span>
                        @endif
                    </div>  --}}
                    {{-- <div class="form-group{{$errors->has('type') ? ' has-error': ''}}">
                        <label for="inputtype">Type</label><br>
                        <select name="type" class="form-control">
                            <option value="kelas"{{(old('type') == 'kelas') ? ' selected' : ''}}>Kelas</option>
                            <option value="lab"{{(old('type') == 'lab') ? ' selected' : ''}}>Lab</option>
                            <option value="aula"{{(old('type') == 'aula') ? ' selected' : ''}}>Aula</option>
                        </select>
                        @if($errors->has('type'))
                        <span class="help-block">{{$errors->first('type')}}</span>
                        @endif
                    </div> --}}
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
        var aula_id = $(this).attr('aula-id');
        swal({
                title: "Yakin?",
                text: "Mau hapus data aula ini ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                console.log(willDelete);
                if (willDelete) {
                   window.location = "/aula/"+aula_id+"/delete";
                } 
            });
    });
</script>

@endsection
