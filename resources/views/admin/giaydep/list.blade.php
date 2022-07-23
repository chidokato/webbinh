@extends('admin.layout.index')
@section('giaydep') menu-item-active @endsection
@section('content')
@include('admin.errors.alerts')
<form action="admin/giaydep/edit" method="POST" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{{csrf_token()}}" />
<div class="text-right mb-3">
    <button type="reset" class="btn-warning mr-2"><i class="fas fa-arrow-left"></i> Back</button>
    <button type="reset" class="btn-danger mr-2"><i class="fas fa-sync"></i> Reset</button>
    <button type="submit" class="btn-success"><i class="far fa-save"></i> Save</button>
</div>
<div class="row">
    <div class="col-xl-6 col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Size</h6>
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
                    @foreach($size as $val)
                    <div class="col-md-6 form-group">
                        <input value="{!! $val->name !!}" name='size[]' type="text" placeholder="Name" class="form-control">
                        <input value="{!! $val->id !!}" name='size_id[]' type="hidden" placeholder="Name" class="form-control">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6 col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Màu sắc</h6>
                <div class="dropdown no-arrow">
                    <a href="admin/giaydep/add"><button type="button" class="btn-success"><i class="far fa-file"></i> Add</button></a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($mausac as $val)
                    <div class="col-md-6 form-group">
                        <input value="{!! $val->name !!}" name='mausac[]' type="text" placeholder="Name" class="form-control">
                        <input value="{!! $val->id !!}" name='mausac_id[]' type="hidden" placeholder="Name" class="form-control">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Form</h6>
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
                    @foreach($form as $val)
                    <div class="col-md-6 form-group">
                        <input value="{!! $val->name !!}" name='form[]' type="text" placeholder="Name" class="form-control">
                        <input value="{!! $val->id !!}" name='form_id[]' type="hidden" placeholder="Name" class="form-control">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    
</div>
</form>
@endsection