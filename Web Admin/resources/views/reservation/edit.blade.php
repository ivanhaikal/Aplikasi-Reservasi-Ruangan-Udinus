@extends('layouts.master')


@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="cool-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Edit Reservation</h3>
                        </div>
                        <div class="panel-body">
                            <form action="/reservation/{{$reservation->id}}/update" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="inputaccountid">Account Id</label>
                                    <input name="accountId" type="number" class="form-control" id="inputaccountid1"
                                        placeholder="inputkan Account Id" value="{{$reservation->accountId}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputroomid">Room Id</label>
                                    <input name="roomId" type="number" class="form-control" id="inputroomid"
                                        placeholder="inputkan Room Id" value="{{$reservation->roomId}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputdate">Tanggal</label>
                                    <input name="date" type="date" class="form-control" id="inputdate1"
                                        placeholder="inputkan Tanggal" value="{{$reservation->date}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputdate">Time Id</label>
                                    <input name="timeId" type="number" class="form-control" id="inputdate1"
                                        placeholder="inputkan TimeId" value="{{$reservation->timeId}}">
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
