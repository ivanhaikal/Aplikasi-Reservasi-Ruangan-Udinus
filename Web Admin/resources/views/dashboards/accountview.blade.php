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
                            <h3 class="panel-title"><b>Account</b></h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Image</th>
                                        <th>Nim/Npp</th>
                                        <th>Name Account</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tangal Lahir</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Register</th>                                      
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (daftarAccountBaru() as $a)
                                    <tr>
                                        <td>{{$a->id}}</td>
                                        <td><img src="{{$a->getProfile()}}" width="50px" height="50px" class="img-circle" alt="Profile Picture"></td>
                                        <td>{{$a->nim_npp}}</td>
                                        <td>{{$a->name_account}}</td>
                                        <td>{{$a->gender}}</td>
                                        <td>{{$a->dob}}</td>
                                        <td>{{$a->phone}}</td>  
                                        <td>{{$a->status}}</td>
                                        <td>{{$a->created_at}}</td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                            {{daftarAccountBaru()->links()}}
                        </div>
                    </div>
                    <!-- END TABLE HOVER -->
                </div>
            </div>
        </div>
    </div>
</div>




@endsection