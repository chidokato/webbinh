@extends('admin.layout.index')
@section('category') menu-item-active @endsection
@section('content')
@include('admin.errors.alerts')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
<form action="admin/category/add" method="POST" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{{csrf_token()}}" />
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Category: add/edit</h5>
                <!--end::Page Title-->
                <!--begin::Actions-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
            </div>
            <!--end::Info-->
            <div class="d-flex align-items-center">
                <!--begin::Actions-->
                <button type="reset" class="btn btn-warning btn-sm  mr-2"><i class="las la-reply"></i> Back</button>
                <button type="reset" class="btn btn-danger btn-sm  mr-2"><i class="las la-sync"></i> Reset</button>
                <button type="submit" class="btn btn-success btn-sm"><i class="las la-save"></i> Save</button>
                <!--end::Actions-->
                
            </div>
        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Dashboard-->
            <!--begin::Row-->
            <div class="row">
                <div class="col-md-8">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header">
                            <h3 class="card-title">Information</h3>
                        </div>
                        <!--begin::Form-->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input value="{{ isset($data) ? $data->name : '' }}" name="name" placeholder="Tên danh mục" type="text" class="form-control">
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
                                        <label class="">Sort by</label>
                                        <select name="sort_by" class="form-control kt_select2_1" id="sort_by">
                                            <option <?php if($data->sort_by ==1){echo 'selected';} ?> value="1">Product</option>
                                            <option <?php if($data->sort_by ==2){echo 'selected';} ?> value="2">News</option>
                                            <option <?php if($data->sort_by ==3){echo 'selected';} ?> value="3">pages</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="">Root</label>
                                        <select id="parent" name='parent' class="form-control kt_select2_1">
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
                            <!--begin: Code-->
                        </div>
                        <!--end::Form-->
                    </div>
                    <!--end::Card-->
                    @include('admin.layout.seooption')

                </div>

                <div class="col-md-4">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header">
                            <h3 class="card-title">Images</h3>

                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="image-input image-input-outline" id="kt_image_1">
                                    <div class="image-input-wrapper" style="background-image: url(data/category/{{ isset($data) ? $data->img : '' }})"></div>
                                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change Images">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="img" accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="profile_avatar_remove" />
                                    </label>
                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                    </span>
                                </div>
                                <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                            </div>

                        </div>
                        <!--end::Form-->
                    </div>
                    <!--end::Card-->
                </div>
            </div>
            <!--end::Row-->
            <!--end::Dashboard-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</form>
</div>
<!--end::Content-->
<!-- ckeditor -->
<script src="ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('ckeditor' ,{
    filebrowserBrowseUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
    filebrowserUploadUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
    filebrowserImageBrowseUrl : 'filemanager/dialog.php?type=1&editor=ckeditor&fldr='
});
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
                
                addeditcat ($data, $value['id'], $str.'___',$select);
            }
        }
    }
?>
@endsection

