@extends('admin.layout.index')
@section('nhaphang') class="active" @endsection
@section('content')
<?php use App\product; ?>
<?php use App\quanlykho; ?>
<form action="admin/banhang/{{ isset($data) ? 'edit/'.$data->id : 'add' }}" method="POST" enctype="multipart/form-data">
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
	                	<div class="col-md-6 form-group">
		                	<label>Kênh bán hàng</label>
							<span>
								<select required name="channel_id" class="form-control select2">
									@foreach($channel as $val)
		                        	<option <?php if(isset($data) && $data->channel->id==$val->id){echo "selected";} ?> value="{{$val->id}}">{{$val->name}}</option>
		                        	@endforeach
		                        </select>
							</span>
		                </div>
						<div class="col-md-6 form-group">
							<label>Ngày bán hàng</label>
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
                    <a href="admin/banhang/add_banhang/{{$data->id}}"><button class="btn-primary" type="button"><i class="far fa-file"></i> Thêm mới</button></a>
                </div>
                @endif
            </div>
            <div class="card-body">
                @if(isset($data))
                @foreach($data->banhang as $b_hang)
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
                        $quanlykho = quanlykho::where('articles_id', $b_hang->articles_id)->where('mausac_id', $b_hang->mausac_id)->orderBy('size','asc')->get();
                    ?>
                    <div class="col-md-2">
                        <label>Size</label>
                        <select name="size[]" class="form-control select_new select2" id="size{{$b_hang->id}}">
                            @foreach($quanlykho as $val)
                            <option <?php if(isset($b_hang->size) && $b_hang->size==$val->size){echo "selected";} ?> value="{{$val->size}}">{{$val->size}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-1">
                        <label>Number</label>
                        <input value='{{$b_hang->number}}' name='number[]' type="text" placeholder="..." class="form-control select_new">
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
                        <a href="admin/banhang/dell_banhang/{{$b_hang->id}}/{{$data->id}}">
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
                            $.get("admin/ajax/mausac/"+id+"/"+a_id,function(data){
                                $("#size{{$b_hang->id}}").html(data);
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
                            <option value=''>--chọn--</option>
                            
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label>Size</label>
                        <select name="size" class="form-control select_new select2" id="size">
                            <option value=''>--chọn--</option>
                            
                        </select>
                    </div>
                    <div class="col-md-1">
                        <label>Number</label>
                        <input name='number' type="text" placeholder="..." class="form-control select_new">
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
                <h6 class="m-0 font-weight-bold text-primary">Khách hàng</h6>
            </div>
            <div class="card-body">
                <div class="row">
	                <div class="col-md-12 form-group">
	                	<label>Khách hàng</label>
						<span class="flex">
							<select name="customer_id" class="form-control select_new width76 select2" id="customer">
								@foreach($customer as $val)
								<option <?php if(isset($data)&&$data->customer_id==$val->id){echo "selected";} ?> value="{{$val->id}}">{{$val->name}}</option>
								@endforeach
                                <option value="0">Thêm mới !</option>
	                        </select>
						</span>
	                </div>
	                <div class="col-md-12" id="showkhang" style="margin-top: 10px;">
	                	@if(isset($data))
                            Tên KH: {{$data->customer->name}}<br>
                            Mã KH: {{$data->customer->code}}<br>
                            SĐT: {{$data->customer->phone}}<br>
                            Địa chỉ: {{$data->customer->address}}
                        @endif
	                </div>
              	</div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection
