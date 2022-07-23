@extends('admin.layout.index')
@section('province') menu-item-active menu-item-open @endsection
@section('content')
@include('admin.layout.header')
@include('admin.errors.alerts')
<div class="d-sm-flex align-items-center justify-content-between mb-3 flex">
    <h2 class="h3 mb-0 text-gray-800 line-1 size-1-3-rem">Danh sách tỉnh thành</h2>
    <!-- <a class="add-iteam" href="admin/news/add"><button class="btn-success form-control" type="button"><i class="fa fa-plus" aria-hidden="true"></i> Thêm mới</button></a> -->
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                <ul class="nav nav-pills">
                    <li><a data-toggle="tab" class="nav-link " href="#all">Tất cả</a></li>
                    <li><a data-toggle="tab" class="nav-link active" href="#public">Hiển thị</a></li>
                    <li><a data-toggle="tab" class="nav-link" href="#hidden">Ẩn</a></li>
                </ul>
            </div>
            <div class="card-body mobile-hide">
                <form action="admin/province/search" class="search" method="post"><input type="hidden" name="_token" value="{{csrf_token()}}" />
                    <div class="form-group mr-3">
                        <input value="{{ isset($key) ? $key : '' }}" name="key" type="text" class="form-control mr-3" placeholder="Tên sp...">
                    </div>
                    <div class="form-group mr-3">
                        <input type="text" class="form-control mr-3" name="datefilter" value="{{ isset($datefilter) ? $datefilter : '' }}" placeholder='Ngày đăng ...' />
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
                <div class="tab-pane overflow" id="all">
                    <table class="table">
                        <form method="post" action="admin/province/delete_all"> <input type="hidden" name="_token" value="{{csrf_token()}}" />
                        <thead>
                            <tr>
                                <th style="position: relative; width: 25px;">
                                    <label class="container"><input onclick="toggle(this);" type="checkbox" id="checkbox"><span class="checkmark"></span></label>
                                    <button type="submit" onclick="dell()" class="btn btn-danger btn-sm  ml-2 delall"><i class="la la-trash"></i> Dell all</button>
                                </th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>User</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($province as $val)
                            <tr id="province">
                                <td>
                                    <label class="container"><input type="checkbox" id="id" name="foo[]" value="{{$val->id}}"><span class="checkmark"></span></label>
                                </td>
                                <td>
                                    {!! isset($val->img) ? '<img src="data/province/80/'.$val->img.'" class="thumbnail-img align-self-center" alt="" />' : '' !!}
                                    {{$val->name}}
                                </td>
                                <td>{{ $val->code }}</td>
                                <td>{{ isset($val->user->name) ? $val->user->name : '' }}</td>
                                <td>
                                    <label class="container"><input id="status_province" <?php if($val->status == 'true'){echo "checked";} ?> type="checkbox" value="{{$val->id}}"><span class="checkmark"></span></label>
                                </td>
                                <td>
                                    {{date('d/m/Y',strtotime($val->created_at))}} / {{date('d/m/Y',strtotime($val->updated_at))}}
                                </td>
                                <td>
                                    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </form>
                    </table>
                </div>
                <div class="tab-pane overflow active" id="public">
                    <table class="table">
                        <form method="post" action="admin/province/delete_all"> <input type="hidden" name="_token" value="{{csrf_token()}}" />
                        <thead>
                            <tr>
                                <th style="position: relative; width: 25px;">
                                    <label class="container"><input onclick="toggle(this);" type="checkbox" id="checkbox"><span class="checkmark"></span></label>
                                    <button type="submit" onclick="dell()" class="btn btn-danger btn-sm  ml-2 delall"><i class="la la-trash"></i> Dell all</button>
                                </th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>User</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($province as $val)
                            @if($val->status=='true')
                            <tr id="province">
                                <td>
                                    <label class="container"><input type="checkbox" id="id" name="foo[]" value="{{$val->id}}"><span class="checkmark"></span></label>
                                </td>
                                <td>
                                    {!! isset($val->img) ? '<img src="data/province/80/'.$val->img.'" class="thumbnail-img align-self-center" alt="" />' : '' !!}
                                    {{$val->name}}
                                </td>
                                <td>{{ $val->code }}</td>
                                <td>{{ isset($val->user->name) ? $val->user->name : '' }}</td>
                                <td>
                                    <label class="container"><input id="status_province" <?php if($val->status == 'true'){echo "checked";} ?> type="checkbox" value="{{$val->id}}"><span class="checkmark"></span></label>
                                </td>
                                <td>
                                    {{date('d/m/Y',strtotime($val->created_at))}} / {{date('d/m/Y',strtotime($val->updated_at))}}
                                </td>
                                <td>
                                    
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                        </form>
                    </table>
                </div>
                <div class="tab-pane overflow" id="hidden">
                    <table class="table">
                        <form method="post" action="admin/province/delete_all"> <input type="hidden" name="_token" value="{{csrf_token()}}" />
                        <thead>
                            <tr>
                                <th style="position: relative; width: 25px;">
                                    <label class="container"><input onclick="toggle(this);" type="checkbox" id="checkbox"><span class="checkmark"></span></label>
                                    <button type="submit" onclick="dell()" class="btn btn-danger btn-sm  ml-2 delall"><i class="la la-trash"></i> Dell all</button>
                                </th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>User</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($province as $val)
                            @if($val->status!='true')
                            <tr id="province">
                                <td>
                                    <label class="container"><input type="checkbox" id="id" name="foo[]" value="{{$val->id}}"><span class="checkmark"></span></label>
                                </td>
                                <td>
                                    {!! isset($val->img) ? '<img src="data/province/80/'.$val->img.'" class="thumbnail-img align-self-center" alt="" />' : '' !!}
                                    {{$val->name}}
                                </td>
                                <td>{{ $val->code }}</td>
                                <td>{{ isset($val->user->name) ? $val->user->name : '' }}</td>
                                <td>
                                    <label class="container"><input id="status_province" <?php if($val->status == 'true'){echo "checked";} ?> type="checkbox" value="{{$val->id}}"><span class="checkmark"></span></label>
                                </td>
                                <td>
                                    {{date('d/m/Y',strtotime($val->created_at))}} / {{date('d/m/Y',strtotime($val->updated_at))}}
                                </td>
                                <td>
                                    
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                        </form>
                    </table>
                </div>
                {{$province->links()}}
            </div>
        </div>
    </div>
</div>
@endsection