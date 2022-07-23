@extends('admin.layout.index')
@section('product') menu-item-active @endsection
@section('content')
@include('admin.errors.alerts')
<form id="validateForm" action="admin/category/{{ isset($data) ? 'edit/'.$data->id : 'add' }}" method="POST" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{{csrf_token()}}" />
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow fixed">
    <button type="button" id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3"><i class="fa fa-bars"></i></button>
    <ul class="navbar-nav ">
        <li class="nav-item"> <a class="nav-link line-1" href="admin/category/list" ><i class="fa fa-chevron-left" aria-hidden="true"></i> <span class="mobile-hide">Quay lại trang trước</span> </a> </li>
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input value="{{ isset($data) ? $data->name : '' }}" name="name" placeholder="Name" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>View</label>
                            <input value="{{ isset($data) ? $data->view : '' }}" name="view" placeholder="View" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Icon</label>
                            <input value="{{ isset($data) ? $data->icon : '' }}" name="icon" placeholder="Icon" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! isset($data) ? '
                            <label>Slug</label>
                            <input value="'.$data->slug.'" name="slug" placeholder="slug" type="text" class="form-control">
                            ' : '
                            <label class="">Sort by</label>
                            <select name="sort_by" class="form-control select2" id="sort_by">
                                <!-- <option value="1">Product</option> -->
                                <option value="2">News</option>
                                <option value="3">pages</option>
                            </select>
                            ' !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="">Root</label>
                            <select id="parent" name='parent' class="form-control select2">
                                <option value="0">-- ROOT --</option>
                                @if(isset($data))
                                <?php addeditcat ($category,0,$str='',$data['parent']); ?>
                                @else
                                <?php addeditcat ($category,0,$str='',old('parent')); ?>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Content</label>
                            <textarea name="content" class="form-control" id="ckeditor">{{ isset($data) ? $data->content : '' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Images</h6>
            </div>
            <div class="card-body">
                <div class="file-upload">
                    <div class="file-upload-content" onclick="$('.file-upload-input').trigger( 'click' )">
                        <img class="file-upload-image" src="{{ isset($data) ? 'data/category/'.$data->img : 'data/no_image.jpg' }}" />
                    </div>
                    <div class="image-upload-wrap">
                        <input name="img" class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
                    </div>
                    <!-- <label><input type="checkbox" name="dell_img">Xóa ảnh</label> -->
                </div>
            </div>

        </div>

        <!-- <div class="card shadow mb-2">
            <div class="card-body">
                <div class="form-group">
                    <div class="checkboxes__item">
                      <label class="checkbox style-e">
                        <input type="checkbox" checked="checked"/>
                        <div class="checkbox__checkmark"></div>
                        <div class="checkbox__body">Style E</div>
                      </label>
                    </div>
                </div>
                <hr class="lines">
                <div class="form-group">
                    <div class="checkboxes__item">
                      <label class="checkbox style-e">
                        <input type="checkbox" checked="checked"/>
                        <div class="checkbox__checkmark"></div>
                        <div class="checkbox__body">Style E</div>
                      </label>
                    </div>
                </div>
            </div>
        </div> -->

    </div>
</div>
</form>
@endsection
@section('function')
<?php 
    function addeditcat ($data, $parent=0, $str='',$select=0)
    {
        foreach ($data as $value) {
            if ($value['parent'] == $parent) {
                if($select != 0 && $value['id'] == $select )
                { ?>
                    <option value="<?php echo $value['id']; ?>" selected> <?php echo $str.$value['name']; ?> </option>
                <?php } else { ?>
                    <option value="<?php echo $value['id']; ?>" > <?php echo $str.$value['name']; ?> </option>
                <?php }
                
                addeditcat ($data, $value['id'], $str.'___',$select);
            }
        }
    }
?>
@endsection

