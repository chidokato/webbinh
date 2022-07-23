@extends('admin.layout.index')
@section('slider') menu-item-active @endsection
@section('content')
@include('admin.errors.alerts')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">List slider</h5>
                <!--end::Page Title-->
                <!--begin::Actions-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <!-- <span class="text-muted font-weight-bold mr-4">#XRS-45670</span> -->
                <a href="admin/slider/add" class="btn btn-primary font-weight-bolder btn-sm"><i class="las la-file"></i> Add</a>
                <!--end::Actions-->
            </div>
            <!--end::Info-->
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
                <div class="col-xxl-12 order-2 order-xxl-1">
                    <!--begin::Advance Table Widget 2-->
                    <div class="card card-custom card-stretch gutter-b">
                        <!--begin::Header-->
                        <!-- <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">New Arrivals</span>
                                <span class="text-muted mt-3 font-weight-bold font-size-sm">More than 400+ new members</span>
                            </h3>
                        </div> -->
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body">
                            <form action="admin/slider/delall" method="POST" >
                            <input type="hidden" name="_token" value="{{csrf_token()}}" />
                            <table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable1">
                                <thead>
                                    <tr>
                                        <th>
                                            <label class="checkbox checkbox-lg checkbox-inline mr-2">
                                                <input onclick="toggle(this);" type="checkbox" value="" id="checkbox">
                                                <span></span>
                                                <button onClick="javascript:return window.confirm('Bạn muốn xóa sản phẩm này?');" type="submit" class="btn btn-danger btn-sm  ml-2 delall"><i class="la la-trash"></i> Del all</button>
                                            </label>
                                        </th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>User</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Hot</th>
                                        <th>View</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="load">
                                    @foreach($slider as $val)
                                    <tr>
                                        <td>
                                            <label class="checkbox checkbox-lg checkbox-inline mr-2">
                                                <input name="id[]" type="checkbox" value="{{$val->id}}">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td class="sorting_1 dtr-control">
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-50 flex-shrink-0">
                                                    {!! isset($val->img) ? '<img src="data/slider/80/'.$val->img.'" class="thumbnail-img align-self-center" alt="" />' : '' !!}
                                                </div>
                                                <div class="ml-3">
                                                    <span class="text-dark-75 font-weight-bold line-height-sm d-block pb-2">{{$val->name}}</span>
                                                    <!-- <a href="#" class="text-muted text-hover-primary">Beier-Mante</a> -->
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ isset($val->category->name) ? $val->category->name : '' }}</td>
                                        <td>{{ isset($val->user->name) ? $val->user->name : '' }}</td>
                                        <td class="text-right">
                                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{date('d/m/Y',strtotime($val->created_at))}}</span>
                                            <span class="text-muted font-weight-bold">{{date('d/m/Y',strtotime($val->updated_at))}}</span>
                                        </td>
                                        <td>Casper-Kerluke</td>
                                        <td>22</td>
                                        <td>10/15/2017</td>
                                        <td nowrap="nowrap">
                                            <a href="admin/slider/edit/{{$val->id}}" class="btn btn-sm btn-clean btn-icon" title="Edit details"><i class="la la-edit"></i></a>
                                            <a href="admin/slider/delete/{{$val->id}}" onClick="javascript:return window.confirm('Bạn muốn xóa sản phẩm này?');" class="btn btn-sm btn-clean btn-icon" title="Delete"><i class="la la-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </form>
                            <!--end: Datatable-->
                        </div>
                    </div>
                    <!--end::Advance Table Widget 2-->
                </div>
            </div>
            <!--end::Row-->
            <!--end::Dashboard-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<!--end::Content-->
@endsection