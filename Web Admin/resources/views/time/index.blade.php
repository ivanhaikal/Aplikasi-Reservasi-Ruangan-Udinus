@extends('layouts.master')

@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="cool-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><b><i class="lnr lnr-clock"></i> TIME</b></h3>
                            <i>kotak pencarian time</i>
                            <div class="right">
                                <button type="button" data-toggle="modal" data-target="#exampleModal">
                                <br><br><i class="lnr lnr-plus-circle" style="padding:5px;"></i>
                                <b>TAMBAH TIME</b></button>
                                </div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>TIME</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data_time as $time)
                                    <tr>
                                        <td>{{$time->id}}</td>
                                        <td>{{$time->time}}</td>
                                        <td><a href="/time/{{$time->id}}/edit" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="#" class="btn btn-danger btn-sm delete" time-id="{{$time->id}}">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$data_time->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="lnr lnr-clock"><b> Time</b></i></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
<!-- INPUT DATA -->
            <div class="modal-body">
                <form action="/time/create" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group{{$errors->has('time') ? ' has-error': ''}}">
                        <label for="inputtime">Time</label>
                        <input name="time" type="text" class="form-control" id="inputtime"
                            placeholder="Masukkan time eg.(00.00-01.00)" value="{{old('time')}}">
                        @if($errors->has('time'))
                        <span class="help-block">{{$errors->first('time')}}</span>
                        @endif
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection

@section('footer')
<script>
    $('.delete').click(function() {
        var time_id = $(this).attr('time-id');
        swal({
                title: "Yakin?",
                text: "Mau hapus data lab ini ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                console.log(willDelete);
                if (willDelete) {
                   window.location = "/time/"+time_id+"/delete";
                } 
            });
    });
</script>

@endsection
