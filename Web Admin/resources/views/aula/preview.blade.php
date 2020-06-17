@extends('layouts.master')

@section('content')

{{-- <style>
    .item1 { grid-area: header; }
    .item2 { grid-area: menu; }
    .item3 { grid-area: main; }
    .item4 { grid-area: right; }
    .item5 { grid-area: footer; }
    
    .grid-container {
      display: grid;
      grid-template-areas:
        'header header header header header header'
        'main main main right right right';
      grid-gap: 5px;
      background-color: #fbfdfb;
      padding: 5px;
    }
    
    .grid-container > div {
      background-color: rgba(255, 255, 255, 0.8);
      text-align: center;
      padding: 20px 0;
      font-size: 30px;
    }
    </style> --}}
    <style>
        img {
          display: block;
          margin-left: auto;
          margin-right: auto;
        }
        </style>
    </head>
    <body>
    
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="panel panel-profile">
                <div class="clearfix">
                    <!-- LEFT COLUMN -->
                    <div class="profile-left">
                        <!-- PROFILE HEADER -->
                        <!-- END PROFILE HEADER -->
                        <!-- PROFILE DETAIL -->
                        <div class="profile-detail">
                            <div class="profile-info">
                                <h4 class="heading">Profil Aula</h4><br>
                                <ul class="list-unstyled list-justify">
                                    <li>ID<span>{{$aula->id}}</span></li>
                                    <li>Kode Aula<span>{{$aula->code}}</span></li>
                                    <li>Nama Aula<span>{{$aula->name}}</span></li>
                                    <li>kapasitas<span>{{$aula->capacity}}</span></li>
                                </ul>
                            </div>
                            <br><br><br><br><br>
                            <div class="text-center"><a href="/aula/{{$aula->id}}/edit" class="btn btn-warning">Edit
                                    Profile</a></div>
                        </div>
                        <!-- END PROFILE DETAIL -->
                    </div>
                    <!-- END LEFT COLUMN -->
                    <!-- RIGHT COLUMN -->
                    <div class="profile-right">
                        <h4 class="heading">Preview Aula</h4>
                        <div class="grid-container"> <br>
                            <img src="{{$aula->getImage()}}" alt="gambar aula" width="80%" class="center">
                            {{-- <div class="item1"><img src="{{url('/images/'.$aula->image)}}" alt="image 1" width="50%"></div> --}}
                            {{-- <div class="item3"><img src="{{url('/images/'.$aula->image_2)}}" alt="image 2" width="50%"></div>
                            <div class="item4"><img src="{{url('/images/'.$aula->image_3)}}" alt="image 3" width="50%"></div> --}}
                          </div><br>                      
                    </div>
                    <!-- END RIGHT COLUMN -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT -->
</div>

@endsection
