@extends('admin.layout.index')
@section('user') menu-item-active @endsection
@section('content')
<div id="alerts">@include('admin.errors.alerts')</div>
<form id="validateForm" action="admin/user/{{ isset($data) ? 'edit/'.$data->id : 'add' }}" method="POST" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{{csrf_token()}}" />

<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow fixed">
    <button type="button" id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3"><i class="fa fa-bars"></i></button>
    <ul class="navbar-nav ">
        <li class="nav-item"> <a class="nav-link line-1" href="admin/user/list" ><i class="fa fa-chevron-left" aria-hidden="true"></i> <span class="mobile-hide">Quay lại trang trước</span> </a> </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item mobile-hide">
            <a class="add-iteam" target="_blank" href="admin/dashboard"><button class="btn-warning form-control" type="button"><i class="fa fa-share" aria-hidden="true"></i> Trang chủ</button></a>
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
    <h2 class="h3 mb-0 text-gray-800 line-1 size-1-3-rem">{{ isset($data) ? $data->your_name : 'Thêm mới' }}</h2>
</div>

<div class="row">
    <div class="col-xl-9 col-lg-9">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Thông tin người dùng</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <!-- <div class="form-group">
                            <label>Tài khoản</label>
                            <input name="name" value="{{ isset($data) ? $data->name : '' }}" type="text" placeholder="Name ..." class="form-control ">
                        </div> -->
                        <div class="form-group">
                            <label>Họ & Tên</label>
                            <input name="your_name" value="{{ isset($data) ? $data->your_name : '' }}" placeholder="your name" type="text" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Đơn vị</label>
                            <select required name="option_id" class="form-control">
                                <option value="">...</option>
                                @foreach($option as $val)
                                <option <?php if(isset($data) && $data->option_id==$val->id){ echo 'selected'; } ?> value="{{$val->id}}">{{$val->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Số điện thoại</label>
                            <div class="input-group">
                                <input name='phone' value="{{ isset($data) ? $data->phone : '' }}" type="text" placeholder="phone ..." class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Ngày sinh</label>
                            <div class="input-group">
                                <input type="date" value="{{ isset($data) ? $data->birthday : '' }}" name="birthday" placeholder="Ngày sinh ..." class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Link facebook</label>
                            <div class="input-group">
                                <input name='facebook' value="{{ isset($data) ? $data->facebook : '' }}" type="text" placeholder="facebook ..." class="form-control">
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Địa chỉ email</label>
                            <input name='email' value="{{ isset($data) ? $data->email : '' }}" type="text" placeholder="Email ..." class="form-control">
                        </div>
                        @if(isset($data))
                        <div class="form-group">
                            <div class="edit_pass"><label>Mật khẩu</label> <label class="cursor_pointer"><input type="checkbox" id='changepassword' name="changepassword" />  <strong>EDIT</strong> </label></div>
                            <input disabled name="password" placeholder="Password" type="password" class="form-control pass">
                        </div>
                        <div class="form-group">
                            <label class="">Nhập lại mật khẩu</label>
                            <input disabled name="passwordagain" placeholder="Confirm password" type="password" class="form-control pass">
                        </div>
                        @else
                        <div class="form-group">
                            <label>Mật khẩu</label>
                            <input  name="password" placeholder="Password" type="password" class="form-control pass">
                        </div>
                        <div class="form-group">
                            <label class="">Nhập lại mật khẩu</label>
                            <input  name="passwordagain" placeholder="Confirm password" type="password" class="form-control pass">
                        </div>
                        @endif
                        <div class="form-group">
                            <label>Quyền người dùng</label>
                            <select name='permission' class="form-control">
                                <option value="0">superadmin</option>
                                <option value="1">admin</option>
                                <option value="2">author</option>
                                <option value="3">member</option>
                            </select>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- @include('admin.layout.seooption') -->
    </div>
    <div class="col-xl-3 col-lg-3">
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
                        <img class="file-upload-image" src="{{ isset($data) ? 'data/user/'.$data->avatar : 'data/no_image.jpg' }}" />
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

<script>

</script>

@endsection