@extends('admin.layout.index')
@section('category') show @endsection
@section('content')
@include('admin.layout.header')
@include('admin.errors.alerts')
<div class="d-sm-flex align-items-center justify-content-between mb-3 flex">
    <h2 class="h3 mb-0 text-gray-800 line-1 size-1-3-rem">Danh sách files</h2>
    <a class="add-iteam" href="admin/category/add"><button class="btn-success form-control" type="button"><i class="fa fa-plus" aria-hidden="true"></i> Thêm mới</button></a>
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
            <!-- <div class="card-body mobile-hide">
                <form action="admin/category/search" class="search" method="post"><input type="hidden" name="_token" value="{{csrf_token()}}" />
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
            <div class="tab-content overflow">
                <div class="tab-pane active" id="tab2">
                    @if(count($category) > 0)
                    <table class="table">
                        <form method="post" action="admin/category/delete_all"><input type="hidden" name="_token" value="{{csrf_token()}}" />
                            <thead>
                                <tr>
                                    <th style="position: relative;">
                                        <label class="container"><input onclick="toggle(this);" type="checkbox" id="checkbox"><span class="checkmark"></span></label>
                                        <button type="submit" onclick="dell()" class="btn btn-danger btn-sm  ml-2 delall"><i class="la la-trash"></i> Dell all</button>
                                    </th>
                                    <!-- <th></th> -->
                                    <th>Name</th>
                                    <!-- <th>Slug</th> -->
                                    <th>SKU</th>
                                    <!-- <th>View</th> -->
                                    <th>Status</th>
                                    <!-- <th>Home</th> -->
                                    <th>User</th>
                                    <!-- <th>Sort By</th> -->
                                    <th>date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php dequycategory ($category,0,$str='',old('parent_id')); ?>  
                            </tbody>
                        </form>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
@section('function')
<?php 
    function dequycategory ($menulist, $parent_id=0, $str='')
    {
        foreach ($menulist as $val) 
        {
            if ($val['parent'] == $parent_id) 
            { 
                ?>
                    <tr id="category" style="border-bottom: 1px solid #f3f6f9;">
                        <input type="hidden" name="id" id="id" value="{{$val->id}}" >
                        <td>
                            <label class="container"><input type="checkbox" name="foo[]" value="{{$val->id}}"><span class="checkmark"></span></label>
                        </td>
                        <!-- <td>{!! isset($val->img) ? '<img data-action="zoom" src="data/category/'.$val->img.'" class="thumbnail-img align-self-end" alt="">' : '' !!}</td> -->
                        <td><a href="admin/category/edit/{{$val->id}}" >{{$str}}{{$val->name}}</a></td>
                        <!-- <td>{{$val->icon}} | {{$val->slug}}</td> -->
                        <td>{{$val->sku}}</td>
                        <!-- <td><input type="text" id="view" value="{{$val->view}}" name="" class="form-control cat_view"></td> -->
                        <td>
                            <label class="container"><input <?php if($val->status == 'true'){echo "checked";} ?> type="checkbox" id='status_cat' ><span class="checkmark"></span></label>
                        </td>
                        <!-- <td>
                            <label class="container"><input <?php if($val->home == 'true'){echo "checked";} ?> type="checkbox" id='home' ><span class="checkmark"></span></label>
                        </td> -->
                        <td>{{$val->user->name}}</td>
                        <!-- <td>
                            @if($val->sort_by==1) Product @endif
                            @if($val->sort_by==2) News @endif
                            @if($val->sort_by==3) Pages @endif
                        </td> -->
                        <td class="date">{{date('d/m/Y',strtotime($val->created_at))}} <sup title="Sửa lần cuối: {{date('d/m/Y',strtotime($val->updated_at))}}"><i class="fa fa-question-circle-o" aria-hidden="true"></i></sup> </td>
                        <td>
                            <!-- <a href="admin/category/double/{{$val->id}}" class="mr-2"><i class="far fa-copy"></i></a> -->
                            <a href="admin/category/edit/{{$val->id}}" class="mr-2"><i class="fas fa-edit" aria-hidden="true"></i></a>
                            <a onclick="dell()" href="admin/category/delete/{{$val->id}}"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                <?php
                dequycategory ($menulist, $val['id'], $str.'_');
            }
        }
    }
?>




@endsection