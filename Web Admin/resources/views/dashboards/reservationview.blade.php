@extends('layouts.master')

@section('content')

<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- TABLE HOVER -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><b>Reservation</b></h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Reservation ID</th>
                                        <th>Account ID</th>
                                        <th>Name Account</th>
                                        <th>Status</th>
                                        <th>Email</th>
                                        <th>Room ID</th>
                                        <th>Room</th>
                                        <th>Time ID</th>
                                        <th>Time</th>
                                        <th>Date</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (daftarReservationBaru() as $r)
                                    <tr>
                                        <td>{{$r->id}}</td>
                                        <td>{{$r->accountId}}</td>
                                        <td>{{$r->name_account}}</td>
                                        <td>{{$r->status}}</td>
                                        <td>{{$r->email_account}}</td>
                                        <td>{{$r->roomId}}</td>
                                        <td>{{$r->name}}</td>
                                        <td>{{$r->timeId}}</td>
                                        <td>{{$r->time}}</td>
                                        <td>{{$r->date}}</td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                            {{daftarReservationBaru()->links()}}
                        </div>
                    </div>
                    <!-- END TABLE HOVER -->
                </div>
            </div>
        </div>
    </div>
</div>


@endsection