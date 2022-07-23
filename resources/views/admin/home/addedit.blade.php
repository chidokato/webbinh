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
            <a class="add-iteam" target="_blank" href="{{ isset($data) ? asset('').$data->category->slug.'/'.$data->slug : asset('') }}"><button class="btn-warning form-control" type="button"><i class="fa fa-share" aria-hidden="true"></i> {{ isset($data) ? 'Xem thực tế' : 'Trang chủ' }}</button></a>
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
                            <input value="{{ isset($data) ? $data->link : '' }}{{old('link')}}" name="link" placeholder="Links" type="text" class="form-control">
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Mô tả ngắn</label>
                            <textarea rows="3" name="detail" class="form-control">{{ isset($data) ? $data->detail : '' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-2">
            @if(isset($data))
            <?php $section_list = section::where('articles_id', $data->id)->orderBy('number','asc')->get(); ?>
            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                <ul class="nav nav-pills">
                    @foreach($section_list as $key => $val)
                    <li><a data-toggle="tab" class="nav-link {{ $key==0? 'active':'' }}" href="#id{{$val->id}}">{{$val->tab_heading}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="tab-content">
                @foreach($section_list as $key => $val)
                <input type="hidden" name="id_section[]" value="{{$val->id}}" />
                <div class="tab-pane overflow {{ $key==0? 'active':'' }}" id="id{{$val->id}}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tab Heading</label>
                                    <input value="{{$val->tab_heading}}" class="form-control" type="text" name="tab_heading[]" placeholder="...">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label>Heading</label>
                                    <input value="{{$val->heading}}" class="form-control" type="text" name="heading[]" placeholder="...">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <textarea name="content_section[]" class="form-control" id="ckeditor{{$key+1}}">{!! $val->content !!}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input class="form-control p-2" type="file" name="img_section{{$key}}[]" multiple placeholder="...">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select name="note_section[]" class="form-control">
                                        <option <?php if($val->note=='style 1'){echo 'selected';} ?> value="style 1"> style 1</option>
                                        <option <?php if($val->note=='style 2'){echo 'selected';} ?> value="style 2"> style 2</option>
                                        <option <?php if($val->note=='style 3'){echo 'selected';} ?> value="style 3"> style 3</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="row detail-img">
                            @foreach($val->images as $val)
                            <div class="col-md-1" style="max-width:10%;flex-basis:10%;" id="detail_img">
                                <img src="data/home/300/{{$val->img}}">
                                <button type="button" id="del_img_detail"> <i class="fa fa-times" aria-hidden="true"></i> </button>
                                <!-- <span>{{$val->note}}</span> -->
                                <input type="hidden" name="id_img_detail" id="id_img_detail" value="{{$val->id}}" />
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
        <div class="card shadow mb-2">
            <div class="card-header py-3 pr-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Thêm Heading</h6>
                <button class="button-none" type="button" id="add_section" onclick="addCode()"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm mới</button>
            </div>
            <div class="card-body add_to_me" id="add_to_me">
                <div class="form-group d-flex align-items-center justify-content-between" id="section_list">
                    <input class="form-control" type="text" name="name_section[]" placeholder="...">
                    <button type="button" onClick="delete_row(this)" class="form-control w100"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>
                </div>
            </div>
        </div>

    </div>
    <div class="col-xl-3 col-lg-3">
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
        <div class="card shadow mb-2">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Chọn nhiều ảnh</h6>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <input type="file" name="imgdetail[]" multiple class="form-control">
                    <p>Nhấn giữ <i style="color: red">Ctrl</i> để chọn nhiều ảnh !</p>
                </div>
                @if(isset($data))
                <div class="row detail-img">
                    @foreach($data->images as $val)
                    <div class="col-md-4" id="detail_img">
                        <img src="data/home/300/{{$val->img}}">
                        <button type="button" id="del_img_detail"> <i class="fa fa-times" aria-hidden="true"></i> </button>
                        <input type="hidden" name="id_img_detail" id="id_img_detail" value="{{$val->id}}" />
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>

        
    </div>
</div>
</form>

@include('admin.home.popup')

<style type="text/css">
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
                '<div class="form-group d-flex align-items-center justify-content-between" id="section_list"><input class="form-control" type="text" name="name_section[]" placeholder="..."><button type="button" onClick="delete_row(this)" class="form-control w100"><i class="fa fa-minus-circle" aria-hidden="true"></i></button></div>');
    }
    function delete_row(e) {
        e.parentElement.remove();
    }
</script>

@endsection





