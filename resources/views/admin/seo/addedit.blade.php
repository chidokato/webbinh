@extends('admin.layout.index')
@section('seo') menu-item-active @endsection
@section('content')
<div id="alerts">@include('admin.errors.alerts')</div>
<form id="validateForm" action="admin/seo/<?php if(isset($data)){if(isset($double)) echo 'add'; else echo 'edit/'.$data->id;}else{ echo 'add'; } ?>" method="POST" enctype="multipart/form-data" id="target">
<input type="hidden" name="_token" value="{{csrf_token()}}" />
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow sticky">
    <button type="button" id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3"><i class="fa fa-bars"></i></button>
    <ul class="navbar-nav ">
        <li class="nav-item"> <a class="nav-link line-1" href="admin/seo/list" ><i class="fa fa-chevron-left" aria-hidden="true"></i> <span class="mobile-hide">Quay lại trang danh sách SEO</span> </a> </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item mobile-hide">
            <a class="add-iteam" target="_blank" href="{{ asset('') }}"><button class="btn-warning form-control" type="button"><i class="fa fa-share" aria-hidden="true"></i> Trang chủ </button></a>
        </li>
        <div class="topbar-divider d-none d-sm-block"></div>
        <li class="nav-item mobile-hide">
            <button type="reset" class="btn-danger mr-2 form-control"><i class="fas fa-sync"></i> Làm mới</button>
        </li>
        <div class="topbar-divider d-none d-sm-block"></div>
        <li class="nav-item">
            <button type="submit" class="btn-success form-control"><i class="far fa-save"></i> Lưu lại</button>
        </li>
    </ul>
</nav>

<div class="d-sm-flex align-items-center justify-content-between mb-3 flex" style="height: 38px;">
    <h2 class="h3 mb-0 text-gray-800 line-1 size-1-3-rem">{{ isset($data) ? $data->name : 'Thêm mới' }}</h2>
</div>

<div class="row">
    <div class="col-xl-9 col-lg-9">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Thông tin</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Title</label>
                            <input value="{{ isset($data) ? $data->title : '' }}{{old('title')}}" id="title" onkeyup="changetitle(this);" name='title' type="text" placeholder="70 characters left" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label >Description</label>
                            <input value="{{ isset($data) ? $data->description : '' }}{{old('description')}}" id="description" onkeyup="change(this);" name='description' type="text" placeholder="170 characters left" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="form-group">
                            <label>keywords</label>
                            <input value="{{ isset($data) ? $data->keywords : '' }}{{old('keywords')}}" name='keywords' type="text" placeholder="keywords ..." class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>Robots</label>
                            <select name='robot' class="form-control">
                                <option <?php if(isset($data) && $data->robot=='index, follow'){echo "selected";} ?> <?php if(old('robot')=='index, follow'){echo"selected";} ?> value="index, follow">index, follow</option>
                                <option <?php if(isset($data) && $data->robot=='noindex, nofollow'){echo "selected";} ?> <?php if(old('robot')=='noindex, nofollow'){echo"selected";} ?> value="noindex, nofollow">noindex, nofollow</option>
                            </select>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3">
        
    </div>
</div>
</form>

@endsection





