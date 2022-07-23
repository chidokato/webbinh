@extends('admin.layout.index')
@section('nhaphang') class="active" @endsection
@section('content')
<?php use App\product; ?>
<?php use App\quanlykho; ?>
<form action="admin/nhaphang/{{ isset($data) ? 'edit/'.$data->id : 'add' }}" method="POST" enctype="multipart/form-data">
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
                <h6 class="m-0 font-weight-bold text-primary">Bán hàng</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Đơn hàng</label>
                            <select {{isset($data)? 'disabled' : ''}} name="order_id" class="form-control select_new select2" id="order">
                                <option value='0'>New order</option>
                                @foreach($order as $val)
                                <option <?php if(isset($data) && $data->id==$val->id){echo "selected disabled";} ?> value="{{$val->id}}">{{$val->code}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div id="showorder" style="display: flex;">
                        <div class="col-md-12 form-group">
                            <label>Ngày nhập hàng</label>
                            <input name="date" type="date" value="{{ isset($data) ? $data->date : date('Y-m-d') }}" class="form-control" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Sản phẩm</h6>
                @if(isset($data))
                <div class="no-arrow">
                    <a href="admin/nhaphang/add_nhaphang/{{$data->id}}"><button class="btn-primary" type="button"><i class="far fa-file"></i> Thêm mới</button></a>
                </div>
                @endif
            </div>
            <div class="card-body">
                @if(isset($data))
                @foreach($data->nhaphang as $b_hang)
                <input type="hidden" name="bh_id[]" value="{{$b_hang->id}}" />
                <div class="row">
                    <div class="col-md-4">
                        <label>Sản phẩm</label>
                        <select name="articles_id[]" class="form-control select_new select2" id="articles{{$b_hang->id}}">
                            <option value=''>--chọn--</option>
                            @foreach($articles as $val)
                            <option <?php if(isset($b_hang->articles_id) && $b_hang->articles_id==$val->id){echo "selected";} ?> value="{{$val->id}}">{{$val->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    {{ isset($product)?$product->mausac_id:'' }}
                    <div class="col-md-2">
                        <label>Màu sắc</label>
                        <select name="mausac_id[]" class="form-control select_new select2" id="mausac{{$b_hang->id}}">
                            @foreach($mausac as $val)
                            @if(isset($b_hang->articles->product->mausac_id) && in_array($val->id, explode(',',$b_hang->articles->product->mausac_id)))
                            <option <?php if(isset($b_hang->mausac_id) && $b_hang->mausac_id==$val->id){echo "selected";} ?> value="{{$val->id}}">{{$val->name}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <?php
                        $quanlykho = quanlykho::where('articles_id', $b_hang->articles_id)->where('mausac_id', $b_hang->mausac_id)->get();
                    ?>
                    <div class="col-md-2">
                        <label>Form</label>
                        <select name="form_id[]" class="form-control select_new select2" id="form{{$b_hang->id}}">
                            <?php $array=array(); foreach($quanlykho as $value ){$array[$value->form_id]= $value;} ?>
                            @foreach ($array as $f)
                            <option <?php if($f->form->id==$b_hang->form_id){echo 'selected';} ?> value="{{$f->form->id}}">{{$f->form->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-1">
                        <label>Number</label>
                        <input value='{{$b_hang->number}}'  name='number[]' type="text" placeholder="..." class="form-control select_new">
                        <input value='{{$b_hang->number}}'  name='number_old[]' type="hidden" placeholder="..." class="form-control select_new">
                    </div>
                    <div class="col-md-2">
                        <label>Giá tiền</label>
                        <span class="flex">
                            <input value='{{$b_hang->price}}'  name='price[]' type="text" placeholder="..." class="form-control select_new">
                        </span>
                    </div>
                    <div class="col-md-1" style="text-align: center;">
                        <label style="width: 100%"></label>
                        <a href="admin/nhaphang/dell_nhaphang/{{$b_hang->id}}/{{$data->id}}">
                            <button class="btn-primary btn-danger" type="button"><i class="fas fa-trash-alt"></i></button>
                        </a>
                    </div>
                </div>
                <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
                <script type="text/javascript">
                    $(document).ready(function(){
                        $("#articles{{$b_hang->id}}").change(function(){
                            var id = $(this).val();
                            $.get("admin/ajax/articles/"+id,function(data){
                                $("#mausac{{$b_hang->id}}").html(data);
                            });
                        });
                    });
                    $(document).ready(function(){
                        $("#mausac{{$b_hang->id}}").change(function(){
                            var id = $(this).val();
                            var a_id = document.getElementById("articles{{$b_hang->id}}").value;
                            // alert(a_id);
                            $.get("admin/ajax/mausac1/"+id+"/"+a_id,function(data){
                                $("#form{{$b_hang->id}}").html(data);
                            });
                        });
                    });
                </script>
                @endforeach
                @else
                <div class="row">
                    <div class="col-md-4">
                        <label>Sản phẩm</label>
                        <select name="articles_id" class="form-control select_new select2" id="articles">
                            <option value=''>--chọn--</option>
                            @foreach($articles as $val)
                            <option value="{{$val->id}}">{{$val->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label>Màu sắc</label>
                        <select name="mausac_id" class="form-control select_new select2" id="mausac">
                            <option value=''>...</option>
                            
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label>Form</label>
                        <select name="form_id" class="form-control select_new " id="form">
                            <option value=''>...</option>
                            
                        </select>
                    </div>
                    <div class="col-md-1">
                        <label>Number</label>
                        <input value=''  name='number' type="text" placeholder="..." class="form-control select_new">
                    </div>
                    <div class="col-md-2">
                        <label>Giá tiền</label>
                        <span class="flex">
                            <input name='price' type="text" placeholder="..." class="form-control select_new">
                        </span>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Nguồn hàng</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label>Nguồn hàng</label>
                        <span class="flex">
                            <select name="supplier_id" class="form-control select_new width76 select2" id="supplier">
                                @foreach($supplier as $val)
                                <option <?php if(isset($data)&&$data->supplier_id==$val->id){echo "selected";} ?> value="{{$val->id}}">{{$val->name}}</option>
                                @endforeach
                                <option value="0">Thêm mới</option>
                            </select>
                        </span>
                    </div>
                    <div class="col-md-12" id="showkhang" style="margin-top: 10px;">
                        @if(isset($data))
                        <ul class="showkhang">
                            <li>
                                <span>Tên: </span><input type="text" value="{{ $data->supplier_id ? $data->supplier->name : '' }}" name="">
                            </li>
                            <li>
                                <span>SĐT: </span><input type="text" value="{{ $data->supplier_id ? $data->supplier->phone : '' }}" name="">
                            </li>
                            <li>
                                <span>Địa chỉ: </span><input type="text" value="{{$data->supplier_id ? $data->supplier->address:''}}" name="">
                            </li>
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
<style type="text/css">
    .showkhang {padding: 0; margin: 0;}
    .showkhang li{list-style: none; display: flex; margin-bottom: 10px;}
    .showkhang li span{width: 20%;}
    .showkhang input{border: none;border-bottom: 1px solid #ddd;width: 80%;}
</style>
@endsection
