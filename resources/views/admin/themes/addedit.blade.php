@extends('admin.layout.index')
@section('themes') menu-item-active @endsection
@section('content')
<div id="alerts">@include('admin.errors.alerts')</div>
<form id="validateForm" action="admin/themes/<?php
if(isset($data)){if(isset($double)) echo 'add';else echo 'edit/'.$data->id;}else{ echo 'add'; }?>" method="POST" enctype="multipart/form-data" id="target">
<input type="hidden" name="_token" value="{{csrf_token()}}" />

<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow fixed">
    <button type="button" id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3"><i class="fa fa-bars"></i></button>
    <ul class="navbar-nav ">
        <li class="nav-item"> <a class="nav-link line-1" href="admin/themes/list" ><i class="fa fa-chevron-left" aria-hidden="true"></i> <span class="mobile-hide">Quay lại trang danh sách sản phẩm</span> </a> </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item mobile-hide">
            <a class="add-iteam" target="_blank" href="{{ isset($data) ? asset('') : asset('') }}"><button class="btn-warning form-control" type="button"><i class="fa fa-share" aria-hidden="true"></i> {{ isset($data) ? 'Trang chủ' : 'Trang chủ' }}</button></a>
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
    <div class="col-xl-8 col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Information</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label>Name</label> 
                            <input value="{{ isset($data) ? $data->name : '' }}" name="name" placeholder="..." type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Note</label> 
                            <select name="note" class="form-control">
                                <option <?php if(isset($data) && $data->note == 'Slider'){echo "selected";} ?> value="Slider">slider</option>
                                <option <?php if(isset($data) && $data->note == 'Banner'){echo "selected";} ?> value="Banner">Banner</option>
                                <option <?php if(isset($data) && $data->note == 'Đối tác'){echo "selected";} ?> value="Đối tác">Đối tác</option>
                                <option <?php if(isset($data) && $data->note == 'logo'){echo "selected";} ?> value="logo">logo</option>
                                <option <?php if(isset($data) && $data->note == 'logo ân bản'){echo "selected";} ?> value="logo ân bản">logo ân bản</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Information</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Title</label> 
                            <input value="{{ isset($data) ? $data->title : '' }}" name="title" placeholder="..." type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="form-group">
                            <label>link</label> 
                            <input value="{{ isset($data) ? $data->link : '' }}" name="link" placeholder="..." type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Button</label> 
                            <input value="{{ isset($data) ? $data->button : '' }}" name="button" placeholder="..." type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>content</label>
                            <textarea rows="3" name="content" class="form-control">{{ isset($data) ? $data->content : '' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Images</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="file-upload">
                    <div class="file-upload-content" onclick="$('.file-upload-input').trigger( 'click' )">
                        <img class="file-upload-image" src="{{ isset($data) ? 'data/themes/'.$data->img : 'data/no_image.jpg' }}" />
                    </div>
                    <div class="image-upload-wrap">
                        <input name="img" class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection

