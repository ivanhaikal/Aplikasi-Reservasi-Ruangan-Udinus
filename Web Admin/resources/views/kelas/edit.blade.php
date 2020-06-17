@extends('layouts.master')


@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="cool-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Edit Kelas</h3>
                        </div>
                        <div class="panel-body">
                            <form action="/kelas/{{$kelas->id}}/update" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="inputkodekelas">Kode Kelas</label>
                                    <input name="code" type="text" class="form-control" id="inputkodekelas1"
                                        placeholder="inputkan kode kelas" value="{{$kelas->code}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputnamakelas">Nama Kelas</label>
                                    <input name="name" type="text" class="form-control" id="inputnamakelas1"
                                        placeholder="inputkan nama kelas" value="{{$kelas->name}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputkapasitas">Kapasitas Kelas</label>
                                    <input name="capacity" type="number" class="form-control" id="inputkapasitas1"
                                        placeholder="inputkan kapasitas" value="{{$kelas->capacity}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputimage">Image</label>
                                    <input type="file" name="image" class="form-control" value="{{$kelas->image}}">
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
