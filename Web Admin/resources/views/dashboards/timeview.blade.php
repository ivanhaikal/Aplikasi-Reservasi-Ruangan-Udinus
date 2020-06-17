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
                            <h3 class="panel-title"><b>Time</b></h3>    
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Time</th>
                                        <th>Upload</th>                                 
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (daftarTime() as $t)
                                    <tr>
                                        <td>{{$t->id}}</td>
                                        <td>{{$t->time}}</td>
                                        <td>{{$t->created_at}}</td>  
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                            {{daftarTime()->links()}}
                        </div>
                    </div>
                    <!-- END TABLE HOVER -->
                </div>
            </div>
        </div>
    </div>
</div>




@endsection