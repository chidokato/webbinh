@extends('admin.layout.index')
@section('district') menu-item-active menu-item-open @endsection
@section('content')
@include('admin.layout.header')
@include('admin.errors.alerts')
<div class="d-sm-flex align-items-center justify-content-between mb-3 flex">
    <h2 class="h3 mb-0 text-gray-800 line-1 size-1-3-rem">Danh sách quận huyện</h2>
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
                <form style="display: flex;" action="admin/district/loc" method="post"><input type="hidden" name="_token" value="{{csrf_token()}}" />
                    <div class="form-group mr-3">
                        <input value="{{ isset($key) ? $key : '' }}" name="key" type="text" class="form-control mr-3" placeholder="Name...">
                    </div>
                    <div class="form-group mr-3">
                        <select style="" class="form-control select2" name="province_id" >
                            <option value="">Tất cả</option>
                            @foreach($province as $val)
                            <option <?php if(isset($province_id) && $province_id==$val->id){echo "selected";} ?> value="{{$val->id}}">{{$val->name}}</option>
                            @endforeach
                        </select>
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
                                <th style="position: relative;">
                                        <label class="container"><input onclick="toggle(this);" type="checkbox" id="checkbox"><span class="checkmark"></span></label>
                                        <button type="submit" onclick="dell()" class="btn btn-danger btn-sm  ml-2 delall"><i class="la la-trash"></i> Dell all</button>
                                    </th>
                                <th>STT</th>
                                <th>Name</th>
                                <th>Province</th>
                                <th>User</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($district as $key => $val)
                            <tr id="district">
                                <td>
                                    <label class="container"><input type="checkbox" id="id" name="foo[]" value="{{$val->id}}"><span class="checkmark"></span></label>
                                </td>
                                <td>{{$key+1}}</td>
                                <td>
                                    {!! isset($val->img) ? '<img src="data/district/80/'.$val->img.'" class="thumbnail-img align-self-center" alt="" />' : '' !!}
                                    {{ $val->prefix }} {{$val->name}}
                                </td>
                                <td>{{ $val->province->name }}</td>
                                <td>{{ isset($val->user->name) ? $val->user->name : '' }}</td>
                                <td>
                                    <label class="container"><input id="status_district" <?php if($val->status == 'true'){echo "checked";} ?> type="checkbox" value="{{$val->id}}"><span class="checkmark"></span></label>
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
                        <form method="post" action="admin/district/delete_all"> <input type="hidden" name="_token" value="{{csrf_token()}}" />
                        <thead>
                            <tr>
                                <th style="position: relative;">
                                        <label class="container"><input onclick="toggle(this);" type="checkbox" id="checkbox"><span class="checkmark"></span></label>
                                        <button type="submit" onclick="dell()" class="btn btn-danger btn-sm  ml-2 delall"><i class="la la-trash"></i> Dell all</button>
                                    </th>
                                <th>STT</th>
                                <th>Name</th>
                                <th>Province</th>
                                <th>User</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($district as $key => $val)
                            @if($val->status=='true')
                            <tr id="district">
                                <td>
                                    <label class="container"><input type="checkbox" id="id" name="foo[]" value="{{$val->id}}"><span class="checkmark"></span></label>
                                </td>
                                <td>{{$key+1}}</td>
                                <td>
                                    {!! isset($val->img) ? '<img src="data/district/80/'.$val->img.'" class="thumbnail-img align-self-center" alt="" />' : '' !!}
                                    {{ $val->prefix }} {{$val->name}}
                                </td>
                                <td>{{ $val->province->name }}</td>
                                <td>{{ isset($val->user->name) ? $val->user->name : '' }}</td>
                                <td>
                                    <label class="container"><input id="status_district" <?php if($val->status == 'true'){echo "checked";} ?> type="checkbox" value="{{$val->id}}"><span class="checkmark"></span></label>
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
                        <form method="post" action="admin/district/delete_all"> <input type="hidden" name="_token" value="{{csrf_token()}}" />
                        <thead>
                            <tr>
                                <th style="position: relative;">
                                        <label class="container"><input onclick="toggle(this);" type="checkbox" id="checkbox"><span class="checkmark"></span></label>
                                        <button type="submit" onclick="dell()" class="btn btn-danger btn-sm  ml-2 delall"><i class="la la-trash"></i> Dell all</button>
                                    </th>
                                <th>STT</th>
                                <th>Name</th>
                                <th>Province</th>
                                <th>User</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($district as $key => $val)
                            @if($val->status!='true')
                            <tr id="district">
                                <td>
                                    <label class="container"><input type="checkbox" id="id" name="foo[]" value="{{$val->id}}"><span class="checkmark"></span></label>
                                </td>
                                <td>{{$key+1}}</td>
                                <td>
                                    {!! isset($val->img) ? '<img src="data/district/80/'.$val->img.'" class="thumbnail-img align-self-center" alt="" />' : '' !!}
                                    {{ $val->prefix }} {{$val->name}}
                                </td>
                                <td>{{ $val->province->name }}</td>
                                <td>{{ isset($val->user->name) ? $val->user->name : '' }}</td>
                                <td>
                                    <label class="container"><input id="status_district" <?php if($val->status == 'true'){echo "checked";} ?> type="checkbox" value="{{$val->id}}"><span class="checkmark"></span></label>
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
                {{$district->links()}}
            </div>
        </div>
    </div>
</div>
@endsection