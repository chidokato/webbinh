@extends('admin.layout.index')
@section('slider') menu-item-active @endsection
@section('content')
@include('admin.errors.alerts')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
<form action="admin/slider/{{ isset($data) ? 'edit/'.$data->id : 'add' }}" method="POST" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{{csrf_token()}}" />
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">slider: add/edit </h5>
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
                <div class="col-md-6">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header">
                            <h3 class="card-title">Information</h3>
                        </div>
                        <!--begin::Form-->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label>Tiêu đề</label>
                                        <input value="{{ isset($data) ? $data->title : '' }}" name="title" placeholder="Tiêu đề" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Font size</label>
                                        <input value="{{ isset($data) ? $data->titlesize : '' }}" name="titlesize" placeholder="Font size" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label>Nội dung</label>
                                        <input value="{{ isset($data) ? $data->text : '' }}" name="text" placeholder="Nội dung" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Font size</label>
                                        <input value="{{ isset($data) ? $data->textsize : '' }}" name="textsize" placeholder="Font size" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nút</label>
                                        <input value="{{ isset($data) ? $data->button : '' }}" name="button" placeholder="Nội dung" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Link</label>
                                        <input value="{{ isset($data) ? $data->link : '' }}" name="link" placeholder="Nội dung" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Màu nút</label>
                                        <input value="{{ isset($data) ? $data->colorbutton : '' }}" name="colorbutton" placeholder="Font size" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <!--begin: Code-->
                        </div>
                        <!--end::Form-->
                    </div>
                    <!--end::Card-->
                </div>

                <div class="col-md-3">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header">
                            <h3 class="card-title">Images</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="image-input image-input-outline" id="kt_image_1">
                                    <div class="image-input-wrapper" style="background-image: url(data/home/{{ isset($data) ? $data->img : '' }})"></div>
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
                <div class="col-md-3">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header">
                            <h3 class="card-title">Images</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="image-input image-input-outline" id="kt_image_1">
                                    <div class="image-input-wrapper" style="background-image: url(data/home/{{ isset($data) ? $data->imgmobile : '' }})"></div>
                                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change Images">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="imgmobile" accept=".png, .jpg, .jpeg" />
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
@endsection
