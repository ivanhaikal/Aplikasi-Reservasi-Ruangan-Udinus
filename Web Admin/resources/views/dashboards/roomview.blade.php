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
                            <h3 class="panel-title"><b>Room</b></h3>    
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Image</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Capacity</th>
                                        <th>type</th>
                                        <th>Upload</th>                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (daftarRoom() as $ro)
                                    <tr>
                                        <td>{{$ro->id}}</td>
                                        <td><img src="{{$ro->getImage()}}" width="50px" height="50px" class="img-circle" alt="Profile Picture"></td>
                                        <td>{{$ro->code}}</td>
                                        <td>{{$ro->name}}</td>
                                        <td>{{$ro->capacity}}</td>
                                        <td>{{$ro->type}}</td>
                                        <td>{{$ro->created_at}}</td>  
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                            {{daftarRoom()->links()}}
                        </div>
                    </div>
                    <!-- END TABLE HOVER -->
                </div>
            </div>
        </div>
    </div>
</div>




@endsection