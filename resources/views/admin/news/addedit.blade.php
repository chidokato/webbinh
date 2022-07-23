@extends('admin.layout.index')
@section('news') menu-item-active @endsection
@section('content')
<div id="alerts">@include('admin.errors.alerts')</div>
<form id="validateForm" action="admin/news/<?php if(isset($data)){if(isset($double)) echo 'add'; else echo 'edit/'.$data->id;}else{ echo 'add'; } ?>" method="POST" enctype="multipart/form-data" id="target">
<input type="hidden" name="_token" value="{{csrf_token()}}" />
<input type="hidden" name="option[]" value="{{ Auth::User()->option->name ? Auth::User()->option->sku : '' }}" />
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow fixed">
    <button type="button" id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3"><i class="fa fa-bars"></i></button>
    <ul class="navbar-nav ">
        <li class="nav-item"> <a class="nav-link line-1" href="admin/news/list" ><i class="fa fa-chevron-left" aria-hidden="true"></i> <span class="mobile-hide">Quay lại trang trước</span> </a> </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item mobile-hide">
            <a class="add-iteam" target="_blank" href=""><button class="btn-warning form-control" type="button"><i class="fa fa-share" aria-hidden="true"></i> {{ isset($data) ? 'Xem thực tế' : 'Trang chủ' }}</button></a>
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
                <h6 class="m-0 font-weight-bold text-primary">Cơ bản</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label style="display: flex;">Tên file</label> 
                            <input value="{{ isset($data) ? $data->name : '' }}" name="name" placeholder="Tên file" type="text" class="form-control">
                            {!! isset($data) ? '
                            <input value="'.$data->slug.'" name="slug" placeholder="slug" type="text" class="slug">
                            ' : '' !!}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Files</label>
                            <select name='cat_id' class="form-control kt_select2_1 select2">
                                <option value="">... </option>
                                @foreach($category as $val)
                                <option <?php if(isset($data) && $data->category_id == $val->id) { echo 'selected'; } ?> value="{{$val->id}}">{{$val->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Dự án</label>
                            <select name='option[]' class="form-control kt_select2_1 select2" multiple>
                                @foreach($option as $val)
                                @if($val->sort_by == 'duan')
                                <option <?php if(isset($data) && in_array($val->sku, explode(',',$data->option_id))){echo 'selected';} ?> value="{{$val->sku}}">{{$val->name}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Thể loại</label>
                            <select name='option[]' class="form-control kt_select2_1 select2" multiple>
                                @foreach($option as $val)
                                @if($val->sort_by == 'theloai')
                                <option <?php if(isset($data) && in_array($val->sku, explode(',',$data->option_id))){echo 'selected';} ?> value="{{$val->sku}}">{{$val->name}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <!-- <div class="col-md-12">
                        <div class="form-group">
                            <label>Detail</label>
                            <textarea rows="3" name="detail" class="form-control">{{ isset($data) ? $data->detail : '' }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Content</label>
                            <textarea name="content" class="form-control ckeditor" id="ckeditor">{{ isset($data) ? $data->content : '' }}</textarea>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
        <div class="card shadow mb-2">
            <div class="card-header py-3 pr-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Link download</h6>
                <button class="button-none" type="button" id="add_section" onclick="addCode()"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm link</button>
            </div>
            <div class="card-body add_to_me" id="add_to_me">
                @if(isset($data))
                @foreach($data->section as $sect)
                <div id="section" class="form-group d-flex align-items-center justify-content-between" id="section_list">
                    <input id="id" value="{{$sect->id}}" class="form-control" type="hidden" name="section_id[]" placeholder="...">
                    <input value="{{$sect->name}}" class="form-control" type="text" name="name_section_edit[]" placeholder="...">
                    <button id="button_option" type="button" onClick="delete_row(this)" class="form-control w100"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>
                </div>
                @endforeach
                @else
                <div class="form-group d-flex align-items-center justify-content-between" id="section_list">
                    <input class="form-control" type="text" name="name_section[]" placeholder="...">
                    <button type="button" onClick="delete_row(this)" class="form-control w100"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>
                </div>
                @endif
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Mô tả chi tiết</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- <div class="col-md-12">
                        <div class="form-group">
                            <label>Detail</label>
                            <textarea rows="3" name="detail" class="form-control">{{ isset($data) ? $data->detail : '' }}</textarea>
                        </div>
                    </div> -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <textarea name="content" class="form-control ckeditor" id="ckeditor">{{ isset($data) ? $data->content : '' }}</textarea>
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
                        <img class="file-upload-image" src="{{ isset($data) ? 'data/news/300/'.$data->img : 'data/no_image.jpg' }}" />
                    </div>
                    <div class="image-upload-wrap">
                        <input name="img" class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="card shadow mb-2">
            <div class="card-body">
                <div class="form-group">
                    <div class="checkboxes__item">
                      <label class="checkbox style-e">
                        <input name="style" {{ isset($data) && $data->style == 'on' ? 'checked':'' }} type="checkbox"/>
                        <div class="checkbox__checkmark"></div>
                        <div class="checkbox__body">Style</div>
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
				
				addeditcat ($data, $value['id'], $str.'__',$select);
			}
		}
	}
?>
@endsection




