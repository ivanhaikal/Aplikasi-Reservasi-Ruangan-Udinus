@extends('layouts.master')


@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="cool-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Edit Aula</h3>
                        </div>
                        <div class="panel-body">
                            <form action="/aula/{{$aula->id}}/update" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="inputkodeaula">Kode Aula</label>
                                    <input name="code" type="text" class="form-control" id="inputkodeaula1"
                                        placeholder="inputkan kode aula" value="{{$aula->code}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputnamaaula">Nama Aula</label>
                                    <input name="name" type="text" class="form-control" id="inputnamaaula1"
                                        placeholder="inputkan nama aula" value="{{$aula->name}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputkapasitas">Kapasitas Aula</label>
                                    <input name="capacity" type="number" class="form-control" id="inputkapasitas1"
                                        placeholder="inputkan kapasitas" value="{{$aula->capacity}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputimage">Image</label>
                                    <input type="file" name="image" class="form-control" value="{{$aula->image}}">
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
