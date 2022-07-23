@extends('admin.layout.index')
@section('setting') menu-item-active @endsection
@section('content')
<div id="alerts">@include('admin.errors.alerts')</div>
<form action="admin/setting/edit/{{$data['id']}}" method="POST" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{{csrf_token()}}" />

<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow sticky">
    <button type="button" id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3"><i class="fa fa-bars"></i></button>
    <ul class="navbar-nav ">
        <!-- <li class="nav-item"> <a class="nav-link line-1" href="admin/setting/list" ><i class="fa fa-chevron-left" aria-hidden="true"></i> <span class="mobile-hide">Quay lại trang danh sách sản phẩm</span> </a> </li> -->
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
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                <ul class="nav nav-pills">
                    <li><a data-toggle="tab" class="nav-link active" href="#home">Thông tin cơ bản</a></li>
                    <li><a data-toggle="tab" class="nav-link " href="#menu1">Mạng xã hội</a></li>
                    <li><a data-toggle="tab" class="nav-link" href="#menu2">Cấu hình SEO</a></li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div id="home" class="tab-pane active">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label >Name</label>
                                <input value="{!! old('name'), isset($data['name'])?$data['name']:null !!}" name='name' type="text" placeholder="Name" class="form-control">
                            </div>
                            <div class="col-md-12 form-group">
                                <label >Address</label>
                                <input value="{!! old('address'), isset($data['address'])?$data['address']:null !!}" name='address' type="text" placeholder="address" class="form-control">
                            </div>
                            <div class="col-md-12 form-group">
                                <label >Email</label>
                                <input value="{!! old('email'), isset($data['email'])?$data['email']:null !!}" name='email' type="text" placeholder="email" class="form-control">
                            </div>
                            <div class="col-md-12 form-group">
                                <label >Hotline</label>
                                <input value="{!! old('hotline'), isset($data['hotline'])?$data['hotline']:null !!}" name='hotline' type="text" placeholder="hotline" class="form-control">
                            </div>
                            <div class="col-md-12 form-group">
                                <label >Tel</label>
                                <input value="{!! old('hotline1'), isset($data['hotline1'])?$data['hotline1']:null !!}" name='hotline1' type="text" placeholder="Tel" class="form-control">
                            </div>
                            
                        </div>
                    </div>
                    <div id="menu1" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label >Facebook</label>
                                    <input value="{!! old('facebook'), isset($data['facebook'])?$data['facebook']:null !!}" name='facebook' type="text" placeholder="facebook" class="form-control">
                                </div>
                                <!-- <div class="form-group">
                                    <label >google plus</label>
                                    <input value="{!! old('googleplus'), isset($data['googleplus'])?$data['googleplus']:null !!}" name='googleplus' type="text" placeholder="googleplus" class="form-control">
                                </div> -->
                                <div class="form-group">
                                    <label >youtube</label>
                                    <input value="{!! old('youtube'), isset($data['youtube'])?$data['youtube']:null !!}" name='youtube' type="text" placeholder="youtube" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label >twitter</label>
                                    <input value="{!! old('twitter'), isset($data['twitter'])?$data['twitter']:null !!}" name='twitter' type="text" placeholder="twitter" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label >Google maps</label>
                                    <textarea name="maps" class="form-control">{!! old('maps'), isset($data['maps'])?$data['maps']:null !!}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="menu2" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input value="{{ isset($data) ? $data->title : '' }}" id="title" onkeyup="changetitle(this);" name='title' type="text" placeholder="70 characters left" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label >Description</label>
                                    <input value="{{ isset($data) ? $data->description : '' }}" id="description" onkeyup="change(this);" name='description' type="text" placeholder="170 characters left" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <label>keywords</label>
                                    <input value="{{ isset($data) ? $data->keywords : '' }}" name='keywords' type="text" placeholder="keywords ..." class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Robots</label>
                                    <select name='robot' class="form-control">
                                        <option <?php if(isset($data) && $data->robot=='index, follow'){echo "selected";} ?> value="index, follow">index, follow</option>
                                        <option <?php if(isset($data) && $data->robot=='noindex, nofollow'){echo "selected";} ?> value="noindex, nofollow">noindex, nofollow</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <label >Favicon (<img src="data/themes/{{ $data ? $data->img : '' }}">)</label>
                                <input type="file" name="favicon" class="form-control">
                            </div>
                            <div class="col-md-12 form-group">
                                <label >Code header</label>
                                <textarea class="form-control" id="message" name="codeheader" rows="10" placeholder="Code header">{!! $data['codeheader'] !!}</textarea>
                            </div>
                            <div class="col-md-12 form-group">
                                <label >Code body</label>
                                <textarea class="form-control" id="message" name="codebody" rows="10" placeholder="Code body">{!! $data['codebody'] !!}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection