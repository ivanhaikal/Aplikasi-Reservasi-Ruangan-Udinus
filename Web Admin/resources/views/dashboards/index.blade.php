@extends('layouts.master')

@section('content')

<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <!-- OVERVIEW -->
            <div class="panel panel-headline">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="lnr lnr-home"> <b>Dashboard</b> </i></h3>
                    <p class="panel-subtitle">
                        <?php
                             $tanggal= mktime(date("m"),date("d"),date("Y"));
                             echo "<b>".date("d-M-Y", $tanggal)."</b> ";
                             date_default_timezone_set('Asia/Jakarta');
                             $jam=date("H:i:s");
                             echo ",<b>". $jam." "."</b>";
                             $a = date ("H");
                        ?></p>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="metric">
                                <span class="icon"><i class="fa fa-building"></i></span>
                                <p>
                                    <span class="number">{{totalRoom()}}</span>
                                    <span class="title"><a href="dashboard/roomview">Room</a></span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="metric">
                                <span class="icon"><i class="fa fa-user"></i></span>
                                <p>
                                    <span class="number">{{totalAccount()}}</span>
                                    <span class="title"><a href="dashboard/accountview">Account</a></span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="metric">
                                <span class="icon"><i class="fa fa-book"></i></span>
                                <p>
                                    <span class="number">{{totalReservation()}}</span>
                                    <span class="title"><a href="dashboard/reservationview">Reservation</a></span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="metric">
                                <span class="icon"><i class="fa fa-hourglass-half"></i></span>
                                <p>
                                    <span class="number">{{totalTime()}}</span>
                                    <span class="title"><a href="dashboard/timeview">Time</a></span>
                                </p>
                            </div>
                        </div>
                    </div>                 
                </div>
           
            </div> 
            <div class="row">
                <div class="col-md-6">
                    <!-- TABLE HOVER -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Reservation</h3>
                            <div class="right">
                                <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up lnr-chevron-down"></i></button>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nim/Npp</th>
                                        <th>Name Account</th>
                                        <th>Reservation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (daftarReservation() as $r)
                                    <tr>
                                        <td>{{$r->id}}</td>
                                        <td>{{$r->nim_npp}}</td>
                                        <td>{{$r->name_account}}</td>
                                        <td>{{$r->created_at}}</td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-md-6"><span class="panel-note"><i class="fa fa-clock-o"></i> Last 5 Reservations</span></div>
                                <div class="col-md-6 text-right"><a href="dashboard/reservationview" class="btn btn-primary">View All Reservation</a></div>
                            </div>
                        </div>
                    </div>
                    <!-- END TABLE HOVER -->

                </div>
                <div class="col-md-6">
                    <!-- TABLE HOVER -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Account</h3>
                            <div class="right">
                                <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up lnr-chevron-down"></i></button>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nim/Npp</th>
                                        <th>Name Account</th>
                                        <th>Register</th>                                      
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (daftarAccount() as $a)
                                    <tr>
                                        <td>{{$a->id}}</td>
                                        <td>{{$a->nim_npp}}</td>
                                        <td>{{$a->name_account}}</td>  
                                        <td>{{$a->created_at}}</td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-md-6"><span class="panel-note"><i class="fa fa-clock-o"></i> Last 5 Account</span></div>
                                <div class="col-md-6 text-right"><a href="dashboard/accountview" class="btn btn-primary">View All Account</a></div>
                            </div>
                        </div>
                    </div>
                    <!-- END TABLE HOVER -->

                </div>
            </div>     
        </div>
    </div>
    
    

    <!-- END MAIN CONTENT -->
</div>
@stop

 