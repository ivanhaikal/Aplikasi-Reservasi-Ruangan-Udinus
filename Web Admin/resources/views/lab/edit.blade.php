@extends('layouts.master')


@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="cool-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Edit Lab</h3>
                        </div>
                        <div class="panel-body">
                            <form action="/lab/{{$lab->id}}/update" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="inputkodelab">Kode Lab</label>
                                    <input name="code" type="text" class="form-control" id="inputkodelab1"
                                        placeholder="inputkan kode lab" value="{{$lab->code}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputnamalab">Nama Lab</label>
                                    <input name="name" type="text" class="form-control" id="inputnamaaula1"
                                        placeholder="inputkan nama lab" value="{{$lab->name}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputkapasitas">Kapasitas Lab</label>
                                    <input name="capacity" type="number" class="form-control" id="inputkapasitas1"
                                        placeholder="inputkan kapasitas" value="{{$lab->capacity}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputimage">Image</label>
                                    <input type="file" name="image" class="form-control" value="{{$lab->image}}">
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
