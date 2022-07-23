@extends('admin.layout.index')
@section('quanlykho') menu-item-active @endsection
@section('content')
@include('admin.errors.alerts')
<?php use App\quanlykho; ?>
<form action="admin/quanlykho/{{ isset($data) ? 'edit/'.$data->id : 'add' }}" method="POST" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{{csrf_token()}}" />
<div class="text-right mb-3">
    <button type="reset" class="btn-warning mr-2"><i class="fas fa-arrow-left"></i> Back</button>
    <button type="reset" class="btn-danger mr-2"><i class="fas fa-sync"></i> Reset</button>
    <button type="submit" class="btn-success"><i class="far fa-save"></i> Save</button>
</div>
<div class="row">
    <div class="col-xl-8 col-lg-8">
        
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"><b>{{$data->name}}</b></h6>
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
                <table class="table">
                    <thead>
                        <tr>
                            <th style="position: relative;">
                                <label class="container"><input onclick="toggle(this);" type="checkbox" id="checkbox"><span class="checkmark"></span></label>
                                <button type="button" class="btn btn-danger btn-sm  ml-2 delall"><i class="la la-trash"></i> Dell all</button>
                            </th>
                            <th>Name</th>
                            <th>Form</th>
                            <th>Size</th>
                            <th><input placeholder="Tồn kho" style="width: 90px;" type="text" name="all_tonkho" class="form-control"></th>
                            <th><input placeholder="Size chân" style="width: 90px;" type="text" name="sizechan" class="form-control"></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $aray_mausac = []; ?>
                        @foreach($mausac as $ms)
                            <?php $quanlykho = quanlykho::where('mausac_id', $ms->id)->where('articles_id', $data->id)->orderBy('size','asc')->get(); ?>
                            @if(count($quanlykho) > 0)
                                @foreach($quanlykho as $val)
                                <input type="hidden" name="id_tk[]" value="{{$val->id}}" />
                                <tr>
                                    <td>
                                        <label class="container"><input type="checkbox" name="foo[]" value="{{$val->id}}"><span class="checkmark"></span></label>
                                    </td>
                                    <td>{{ $val->articles->name }} {{ $val->mausac->name }}</td>
                                    <td>{{ $val->form->name }}</td>
                                    <td>{{ $val->size }}</td>
                                    <td><input style="width: 90px;" type="number" value="{{ $val->tonkho }}" name="tonkho[]" class="form-control"></td>
                                    <td>{{ $val->sizechan }}</td>
                                    <td><a href="admin/quanlykho/delete/{{$data->id}}/{{$val->id}}"><i class="fas fa-trash-alt"></i></a></td>
                                </tr>
                                @endforeach
                            <?php $aray_mausac[] = $ms->id; ?>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Tùy chọn</h6>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Name</label> 
                    <input disabled value="{{ isset($data) ? $data->name : '' }}" name="name" placeholder="Name" type="text" class="form-control">
                </div>
            
                <div class="form-group">
                    <label>Màu Sắc</label> 
                    <select required name="mausac[]" class="form-control select2" multiple>
                        @foreach($mausac as $val)
                        <option <?php if(in_array($val->id, explode(',',$data->product->mausac_id))){echo 'selected';} ?> value="{{$val->id}}">{{$val->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Form</label> 
                    <select required name="form" class="form-control select2">
                        @foreach($form as $val)
                        <option value="{{$val->id}}">{{$val->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Size</label> 
                    <select name="size[]" class="form-control select2" multiple>
                        @foreach($size as $val)
                        <option value="{{$val->name}}">{{$val->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        
        <!-- <div class="card shadow mb-4">
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
                        <img class="file-upload-image" src="data/quanlykho/300/{{ isset($data) ? $data->img : 'no_image.jpg' }}" />
                    </div>
                    <div class="image-upload-wrap">
                        <input name="img" class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</div>
</form>
<style type="text/css">
    .table td, .table th {padding: 3px;}
</style>
@endsection
