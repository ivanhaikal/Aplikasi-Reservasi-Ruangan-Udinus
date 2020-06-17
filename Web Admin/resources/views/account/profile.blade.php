@extends('layouts.master')

@section('content')

<style>
#nama{
    text-align: center;
}

</style>
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="col-sm-6 col-sm-offset-3">
                <!-- PANEL HEADLINE -->
                <div class="panel panel-headline">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-user"></i>Profile</h3>
                    </div>
                    <div class="panel-body">
                        <div class="profile-header">
                            <div class="profilee">
                                <img src="{{$account->getProfile()}}" class="img-circle" alt="Profile Picture" width="80px" height="80px">
                            </div>       
                        </div>
                        <h3 id="nama">{{$account->name_account}}</h3>
                        <hr style="margin-top: 15px; margin-bottom: 5px;">
                        <div class="profile-detail">
                            <div class="profile-info">
                                <h4 class="heading">Profile Account</h4>
                                <ul class="list-unstyled list-justify">
                                    <li>Id<span>{{$account->id}}</span></li>
                                    <li>Nim/Npp<span>{{$account->name_account}}</span></li>
                                    <li>Jenis Kelamin<span>{{$account->gender}}</span></li>
                                    <li>Tanggal Lahir<span>{{$account->dob}}</span></li>
                                    <li>Phone<span>{{$account->phone}}</span></li>
                                    <li>Email<span>{{$account->email_account}}</li>
                                    <li>Status<span>{{$account->status}}</li>
                                    {{-- <li>Password<span>{{$account->password}}</li> --}}
                                </ul>
                            </div>
                            <div class="text-center"><a href="/account/{{$account->id}}/edit" class="btn btn-warning">Edit
                                Profile</a></div>
                        </div>
                    </div>
                </div>
                <!-- END PANEL HEADLINE -->
            </div>
           
           
        </div>
    </div>
    <!-- END MAIN CONTENT -->
</div>

@endsection