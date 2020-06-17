@extends('layouts.master')


@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="cool-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Edit Time</h3>
                        </div>
                        <div class="panel-body">
                            <form action="/time/{{$time->id}}/update" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="inputtime">Time</label>
                                    <input name="time" type="text" class="form-control" id="inputtime1"
                                        placeholder="inputkan Account Id" value="{{$time->time}}">
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
