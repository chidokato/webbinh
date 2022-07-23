@extends('admin.layout.index')
@section('user') menu-item-active @endsection
@section('content')
@include('admin.layout.header')
@include('admin.errors.alerts')
<div class="d-sm-flex align-items-center justify-content-between mb-3 flex">
    <h2 class="h3 mb-0 text-gray-800 line-1 size-1-3-rem">Danh sách sản phẩm</h2>
    <a class="add-iteam" href="admin/user/add"><button class="btn-success form-control" type="button"><i class="fa fa-plus" aria-hidden="true"></i> Thêm mới</button></a>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                <ul class="nav nav-pills">
                    <li><a data-toggle="tab" class="nav-link active" href="#tab1">Tất cả</a></li>
                    <!-- <li><a data-toggle="tab" class="nav-link " href="#tab2">Hiển thị</a></li> -->
                    <!-- <li><a data-toggle="tab" class="nav-link" href="#tab3">Ẩn</a></li> -->
                </ul>
            </div>
            <div class="card-body mobile-hide">
                <form action="admin/user/search" class="search" method="post"><input type="hidden" name="_token" value="{{csrf_token()}}" />
                    <div class="form-group mr-3">
                        <input value="{{ isset($key) ? $key : '' }}" name="key" type="text" class="form-control mr-3" placeholder="Tên người dùng...">
                    </div>
                    <div class="form-group mr-3">
                        <input type="text" class="form-control mr-3" name="datefilter" value="{{ isset($datefilter) ? $datefilter : '' }}" placeholder='Ngày thêm ...' />
                    </div>
                    <div class="form-group mr-3">
                        <select class="form-control mr-3" name="paginate">
                            <option <?php if(isset($paginate) && $paginate=='50'){echo "selected";} ?> value="50">50</option>
                            <option <?php if(isset($paginate) && $paginate=='100'){echo "selected";} ?> value="100">100</option>
                            <option <?php if(isset($paginate) && $paginate=='200'){echo "selected";} ?> value="200">200</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary form-control" type="submit">
                            <i class="fas fa-search fa-sm"></i> Tìm kiếm
                        </button>
                    </div>
                </form>
            </div>

            <div class="tab-content ">
                <div class="tab-pane overflow active" id="tab1">
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Họ & tên</th>
                                <th>Chi nhánh</th>
                                <th>Quyền người dùng</th>
                                <th>Địa chỉ email</th>
                                <th>Số điện thoại</th>
                                <th>Ngày thêm</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user as $val)
                            <tr>
                                <td>
                                    {!! isset($val->img) ? '<img style="width: 48px; height: 48px; object-fit: cover;" src="data/user/80/'.$val->img.'" class="thumbnail-img align-self-center" alt="" />' : '' !!}
                                </td>
                                <td class="name"><a href="admin/user/edit/{{$val->id}}">{{$val->your_name}}  </a></td>
                                <td class="name">{{$val->option->name}}</td>
                                <td>
                                    <?php
                                        switch ($val->permission) {
                                            case "0": echo "superadmin"; break;
                                            case "1": echo "admin"; break;
                                            case "2": echo "author"; break;
                                            default: echo "none";
                                        }
                                    ?>
                                </td>
                                <td>{{$val->email}}</td>
                                <td>{{$val->phone}}</td>
                                <td>
                                    {{date('d/m/Y',strtotime($val->updated_at))}}
                                </td>
                                <td>
                                    <a href="admin/user/edit/{{$val->id}}" class="mr-2"></a>
                                    <a href="admin/user/delete/{{$val->id}}"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    
</style>
@endsection