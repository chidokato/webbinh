@extends('admin.layout.index')
@section('home') menu-item-active @endsection
@section('content')
@include('admin.errors.alerts')
<?php use App\section; ?>
<form id="validateForm" action="admin/home/<?php if(isset($data)){if(isset($double)) echo 'add'; else echo 'edit/'.$data->id;}else{ echo 'add'; }?>" method="POST" enctype="multipart/form-data" id="target">
<input type="hidden" name="_token" value="{{csrf_token()}}" />
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow fixed">
    <button type="button" id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3"><i class="fa fa-bars"></i></button>
    <ul class="navbar-nav ">
        <li class="nav-item"> <a class="nav-link line-1" href="admin/home/list" ><i class="fa fa-chevron-left" aria-hidden="true"></i> <span class="mobile-hide">Quay lại trang trước</span> </a> </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item mobile-hide">
            <a class="add-iteam" target="_blank" href="{{ asset('') }}"><button class="btn-warning form-control" type="button"><i class="fa fa-share" aria-hidden="true"></i> Trang chủ</button></a>
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
        <div class="card shadow mb-2">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Thông tin</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label style="display: flex;">Tên</label> 
                            <input value="{{ isset($data) ? $data->name : '' }}{{old('name')}}" name="name" placeholder="Name" type="text" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label style="display: flex;">Links</label> 
                            <textarea rows="5" name="links" class="form-control">{{ isset($data) ? $data->links : '' }}</textarea>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Mô tả ngắn</label>
                            <textarea rows="5" name="detail" class="form-control">{{ isset($data) ? $data->detail : '' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div style="text-align: right;">
            <button class="button-none" type="button" id="add_section" onclick="addCode()"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm Section</button>
        </div>
        @if(isset($data))
        @foreach($data->section as $key => $val)
        <div class="card shadow mb-2">
            <div class="card-header py-3 pr-3 d-flex flex-row align-items-center justify-content-between" id="list_section">
                <h6 class="m-0 font-weight-bold text-primary">Section</h6>
                <button type="button" onClick="delete_row(this)" class="delete_row"><i class="fa fa-times" aria-hidden="true"></i></button>
                <input id="id" type="hidden" name="section_id[]" value="{{$val->id}}" />
            </div>
            <div class="card-body add_to_me">
                <div class="d-flex">
                    <div style="margin-right: 20px;">
                        <div class="row">
                            <div class="col-md-7 form-group">
                                <label>Name</label>
                                <input class="form-control" type="text" value="{{$val->name}}" name="name_edit_section[]" placeholder="...">
                            </div>
                            <div class="col-md-5 form-group">
                                <label>Images</label>
                                <input class="form-control" type="file" name="img_edit_section[]" placeholder="...">
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Links</label>
                                <input class="form-control" type="text" value="{{$val->link}}" name="link_edit_section[]" placeholder="...">
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Content</label>
                                <textarea name="content_edit_section[]" class="form-control" rows="4">{{$val->content}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <img style="max-width: 100%; height: 253px" src="data/home/{{$val->img}}">
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endif

        <div id="add_to_me">
            <!-- <div class="card shadow mb-2" >
                <div class="card-header py-3 pr-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Add Section</h6>
                    <button type="button" onClick="delete_row(this)" class="delete_row"><i class="fa fa-times" aria-hidden="true"></i></button>
                </div>
                <div class="card-body add_to_me">
                    <div class="row">
                        <div class="col-md-7 form-group">
                            <input class="form-control" type="text" name="name_section[]" placeholder="...">
                        </div>
                        <div class="col-md-5 form-group">
                            <input class="" type="file" name="img_section[]" placeholder="...">
                        </div>
                        <div class="col-md-12 form-group">
                            <textarea name="content_section[]" class="form-control" rows="4"></textarea>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>

    </div>
    <div class="col-xl-3 col-lg-3">
        <div class="card shadow mb-2">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Tùy chọn</h6>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>View</label>
                    <input class="form-control" type="text" value="{{ isset($data) ? $data->view : '' }}{{old('view')}}" name="view" placeholder="...">
                </div>
            </div>
        </div>

        <div class="card shadow mb-2">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Ảnh đại diện</h6>
            </div>
            <div class="card-body">
                <div class="file-upload">
                    <div class="file-upload-content" onclick="$('.file-upload-input').trigger( 'click' )">
                        <img class="file-upload-image" src="{{ isset($data) ? 'data/home/300/'.$data->img : '' }}" />
                        <span style="cursor: pointer;"><i class="fa fa-plus" aria-hidden="true"></i> Tải ảnh lên từ thiết bị</span>
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

@include('admin.home.popup')

<style type="text/css">
    .delete_row{
        border: none;
        border-radius: 100px;
        width: 25px;
        height: 25px;
        background: red;
        color: #fff;box-shadow: rgb(168 168 168) 3px 3px 6px;
    }
    .button_section{
        background: none; border: 2px solid #fff; border-radius: 5px;
    }
    .button_section:hover{
        border: 2px solid #ddd; border-radius: 5px;
    }
    /*.input_section{
        border: none;
        border-bottom: 1px solid #ddd;
        width: 100%;
        border-radius: 0px;
        padding-left: 0px;
    }
    .input_section:focus{
        box-shadow: none;
    }*/
    .chinhsach{
        display: flex;justify-content: space-between;
    }
    .chinhsach .checkbox.style-e .checkbox__checkmark{
        top: -14px;
    }
</style>

<script>
    function addCode() {
        document.getElementById("add_to_me").insertAdjacentHTML("beforeend",
                '<div class="card shadow mb-2" ><div class="card-header py-3 pr-3 d-flex flex-row align-items-center justify-content-between"><h6 class="m-0 font-weight-bold text-primary">Add Section</h6><button type="button" onClick="delete_row(this)" class="delete_row"><i class="fa fa-times" aria-hidden="true"></i></button></div><div class="card-body add_to_me"><div class="row"><div class="col-md-7 form-group"><input class="form-control" type="text" name="name_section[]" placeholder="..."></div><div class="col-md-5 form-group"><input class="" type="file" name="img_section[]" placeholder="..."></div><div class="col-md-12 form-group"><textarea name="content_section[]" class="form-control" rows="4"></textarea></div></div></div></div>');
    }
    function delete_row(e) {
        e.parentElement.parentElement.remove();
    }
</script>

@endsection





