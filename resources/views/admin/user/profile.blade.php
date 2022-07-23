@extends('admin.layout.index')
@section('user') menu-item-active @endsection
@section('content')
@include('admin.errors.alerts')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Trang cá nhân</h1>
</div>

<div class="row">
    <div class="col-xl-9 col-md-7 mb-9">
        <div class="card border-left-primary shadow">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Danh mục bạn đã thêm</h6>
                <div class="no-arrow">
                    <a href="admin/category/list" role="button">Xem thêm</a>
                </div>
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
                        @foreach($category as $val)
                        <tr>
                            <td>{{$val->name}} </td>
                            <td>
                                <label class="container"><input <?php if($val->status == 'true'){echo "checked";} ?> type="checkbox" id='status' ><span class="checkmark"></span></label>
                            </td>
                            <td>
                                {{date('d/m/Y',strtotime($val->updated_at))}}
                                <i style="font-size: 14px">{{date('d/m/Y',strtotime($val->created_at))}}</i>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <div class="card border-left-primary shadow">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Sản phẩm bạn đã thêm</h6>
                <div class="no-arrow">
                    <a href="admin/product/list" role="button">Xem thêm</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Category</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product as $val)
                        <tr>
                            <td>{{$val->name}} </td>
                            <td>
                                <label class="container"><input <?php if($val->status == 'true'){echo "checked";} ?> type="checkbox" id='status' ><span class="checkmark"></span></label>
                            </td>
                            <td>{{ isset($val->category->name) ? $val->category->name : '' }}</td>
                            <td>
                                {{date('d/m/Y',strtotime($val->updated_at))}}
                                <i style="font-size: 14px">{{date('d/m/Y',strtotime($val->created_at))}}</i>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <div class="card border-left-primary shadow">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Tin tức bạn đã thêm</h6>
                <div class="no-arrow">
                    <a href="admin/news/list" role="button">Xem thêm</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Category</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($news as $val)
                        <tr>
                            <td>{{$val->name}} </td>
                            <td>
                                <label class="container"><input <?php if($val->status == 'true'){echo "checked";} ?> type="checkbox" id='status' ><span class="checkmark"></span></label>
                            </td>
                            <td>{{ isset($val->category->name) ? $val->category->name : '' }}</td>
                            <td>
                                {{date('d/m/Y',strtotime($val->updated_at))}}
                                <i style="font-size: 14px">{{date('d/m/Y',strtotime($val->created_at))}}</i>
                            </td>
                        </tr>
                        @endforeach
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