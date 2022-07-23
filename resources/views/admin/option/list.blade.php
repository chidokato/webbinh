@extends('admin.layout.index')
@section('option') menu-item-active @endsection
@section('content')
@include('admin.layout.header')
@include('admin.errors.alerts')
<div class="d-sm-flex align-items-center justify-content-between mb-3 flex">
    <h2 class="h3 mb-0 text-gray-800 line-1 size-1-3-rem">Danh sách @if($key=='chinhanh') chi nhánh @elseif($key=='duan') dự án @elseif($key=='theloai') thể loại @endif </h2>
    <a class="add-iteam" href="admin/option/add/{{$key}}"><button class="btn-success form-control" type="button"><i class="fa fa-plus" aria-hidden="true"></i> Thêm mới</button></a>
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
            <!-- <div class="card-body mobile-hide">
                <form action="admin/option/search" class="search" method="post"><input type="hidden" name="_token" value="{{csrf_token()}}" />
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
            </div> -->
            <div class="tab-content ">
                <div class="tab-pane overflow" id="all">
                    <table class="table">
                        <form method="post" action="admin/option/delete_all"> <input type="hidden" name="_token" value="{{csrf_token()}}" />
                        <thead>
                            <tr>
                                <th style="position: relative; width: 25px;padding-left: 15px">
                                    <label class="container"><input onclick="toggle(this);" type="checkbox" id="checkbox"><span class="checkmark"></span></label>
                                    <button type="submit" onclick="dell()" class="btn btn-danger btn-sm  ml-2 delall"><i class="la la-trash"></i> Dell all</button>
                                </th>
                                <th></th>
                                <th>Name</th>
                                <th>Sku</th>
                                <th>Status</th>
                                <th>User</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($option as $val)
                            <tr id="option">
                                <input type="hidden" id="id" value="{{$val->id}}" />
                                <td class="td_checkbox" style="padding-left: 15px;">
                                    <label class="container"><input type="checkbox" name="foo[]" value="{{$val->id}}"><span class="checkmark"></span></label>
                                </td>
                                <td class="thumbnail-img">
                                    {!! isset($val->img) ? '<img data-action="zoom" src="data/news/80/'.$val->img.'" />' : '<img data-action="zoom" src="'.$val->img2.'" />' !!}
                                </td>
                                <td><a href="admin/option/edit/{{$val->id}}/{{$key}}">{{$val->name}}</a></td>
                                <td>{{$val->sku}}</td>
                                <td>
                                    <div class="checkboxes__item">
                                        <label class="checkbox style-e text-none">
                                            <input type="checkbox" <?php if($val->status == 'true'){echo "checked";} ?> type="checkbox" id='status_option'/>
                                            <div class="checkbox__checkmark"></div>
                                            <div class="checkbox__body"></div>
                                        </label>
                                    </div>
                                </td>
                                <td>{{ isset($val->user->name) ? $val->user->name : '' }}</td>
                                <td>
                                    <!-- {{date('d/m/Y',strtotime($val->updated_at))}} <br>  -->
                                    <i style="font-size: 14px">{{date('d/m/Y',strtotime($val->created_at))}}</i>
                                </td>
                                <td class="d-flex">
                                    <!-- <a href="admin/option/double/{{$val->id}}" class="mr-2"><i class="far fa-copy"></i></a> -->
                                    <a href="admin/option/edit/{{$val->id}}/{{$key}}" class="mr-2"><i class="fas fa-edit" aria-hidden="true"></i></a>
                                    <a onclick="dell()" href="admin/option/delete/{{$val->id}}"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </form>
                    </table>
                </div>
                <div class="tab-pane overflow active" id="public">
                    <table class="table">
                        <form method="post" action="admin/option/delete_all"> <input type="hidden" name="_token" value="{{csrf_token()}}" />
                        <thead>
                            <tr>
                                <th style="position: relative; width: 25px;padding-left: 15px">
                                    <label class="container"><input onclick="toggle(this);" type="checkbox" id="checkbox"><span class="checkmark"></span></label>
                                    <button type="submit" onclick="dell()" class="btn btn-danger btn-sm  ml-2 delall"><i class="la la-trash"></i> Dell all</button>
                                </th>
                                <th></th>
                                <th>Name</th>
                                <th>Sku</th>
                                <th>Status</th>
                                <th>User</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($option as $val)
                            @if($val->status=='true')
                            <tr id="option">
                                <input type="hidden" id="id" value="{{$val->id}}" />
                                <td class="td_checkbox" style="padding-left: 15px;">
                                    <label class="container"><input type="checkbox" name="foo[]" value="{{$val->id}}"><span class="checkmark"></span></label>
                                </td>
                                <td class="thumbnail-img">
                                    {!! isset($val->img) ? '<img data-action="zoom" src="data/news/80/'.$val->img.'" />' : '<img data-action="zoom" src="'.$val->img2.'" />' !!}
                                </td>
                                <td><a href="admin/option/edit/{{$val->id}}/{{$key}}">{{$val->name}}</a></td>
                                <td>{{$val->sku}}</td>
                                <td>
                                    <div class="checkboxes__item">
                                        <label class="checkbox style-e text-none">
                                            <input type="checkbox" <?php if($val->status == 'true'){echo "checked";} ?> type="checkbox" id='status_option'/>
                                            <div class="checkbox__checkmark"></div>
                                            <div class="checkbox__body"></div>
                                        </label>
                                    </div>
                                </td>
                                <td>{{ isset($val->user->name) ? $val->user->name : '' }}</td>
                                <td>
                                    <!-- {{date('d/m/Y',strtotime($val->updated_at))}} <br>  -->
                                    <i style="font-size: 14px">{{date('d/m/Y',strtotime($val->created_at))}}</i>
                                </td>
                                <td class="d-flex">
                                    <!-- <a href="admin/option/double/{{$val->id}}" class="mr-2"><i class="far fa-copy"></i></a> -->
                                    <a href="admin/option/edit/{{$val->id}}/{{$key}}" class="mr-2"><i class="fas fa-edit" aria-hidden="true"></i></a>
                                    <a onclick="dell()" href="admin/option/delete/{{$val->id}}"><i class="fas fa-trash-alt"></i></a>
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
                        <form method="post" action="admin/option/delete_all"> <input type="hidden" name="_token" value="{{csrf_token()}}" />
                        <thead>
                            <tr>
                                <th style="position: relative; width: 25px;padding-left: 15px">
                                    <label class="container"><input onclick="toggle(this);" type="checkbox" id="checkbox"><span class="checkmark"></span></label>
                                    <button type="submit" onclick="dell()" class="btn btn-danger btn-sm  ml-2 delall"><i class="la la-trash"></i> Dell all</button>
                                </th>
                                <th></th>
                                <th>Name</th>
                                <th>Sku</th>
                                <th>Status</th>
                                <th>User</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($option as $val)
                            @if($val->status!='true')
                            <tr id="option">
                                <input type="hidden" id="id" value="{{$val->id}}" />
                                <td class="td_checkbox" style="padding-left: 15px;">
                                    <label class="container"><input type="checkbox" name="foo[]" value="{{$val->id}}"><span class="checkmark"></span></label>
                                </td>
                                <td class="thumbnail-img">
                                    {!! isset($val->img) ? '<img data-action="zoom" src="data/news/80/'.$val->img.'" />' : '<img data-action="zoom" src="'.$val->img2.'" />' !!}
                                </td>
                                <td><a href="admin/option/edit/{{$val->id}}/{{$key}}">{{$val->name}}</a></td>
                                <td>{{$val->sku}}</td>
                                <td>
                                    <div class="checkboxes__item">
                                        <label class="checkbox style-e text-none">
                                            <input type="checkbox" <?php if($val->status == 'true'){echo "checked";} ?> type="checkbox" id='status_option'/>
                                            <div class="checkbox__checkmark"></div>
                                            <div class="checkbox__body"></div>
                                        </label>
                                    </div>
                                </td>
                                <td>{{ isset($val->user->name) ? $val->user->name : '' }}</td>
                                <td>
                                    <!-- {{date('d/m/Y',strtotime($val->updated_at))}} <br>  -->
                                    <i style="font-size: 14px">{{date('d/m/Y',strtotime($val->created_at))}}</i>
                                </td>
                                <td class="d-flex">
                                    <!-- <a href="admin/option/double/{{$val->id}}" class="mr-2"><i class="far fa-copy"></i></a> -->
                                    <a href="admin/option/edit/{{$val->id}}/{{$key}}" class="mr-2"><i class="fas fa-edit" aria-hidden="true"></i></a>
                                    <a onclick="dell()" href="admin/option/delete/{{$val->id}}"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection