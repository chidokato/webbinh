@extends('admin.layout.index')
@section('user') menu-item-active @endsection
@section('content')
@include('admin.errors.alerts')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Thông báo</h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
</div>

<div class="row">
    <div class="col-xl-9 col-md-7 mb-9">
        <div class="card border-left-primary shadow">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Thông báo từ admin</h6>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-5 mb-3">
        <div class="card border-left-success shadow">
            <div class="card-body profile">
                <div class="profile_img"><img class="rounded-circle" src="data/user/{{$data->avatar}}"></div>
                <h1>{{$data->your_name}}</h1>
                <ul>
                    <li>{{$data->name}}</li>
                    <li>{{$data->phone}}</li>
                    <li>{{$data->email}}</li>
                    <li>{{$data->birthday}}</li>
                    <li> <a href="{{$data->facebook}}">Facebook</a> </li>
                </ul>
            </div>
        </div>
    </div>

</div>

@endsection