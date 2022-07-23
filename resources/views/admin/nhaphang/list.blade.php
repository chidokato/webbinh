@extends('admin.layout.index')
@section('nhaphang') menu-item-active @endsection
@section('content')
@include('admin.errors.alerts')
<?php use App\nhaphang; ?>
<div class="d-sm-flex align-items-center justify-content-between mb-3">
    <!-- <h1 class="h3 mb-0 text-gray-800">List Category</h1> -->
    <form style="display: flex;" action="admin/nhaphang/search" method="post"><input type="hidden" name="_token" value="{{csrf_token()}}" />
        <div class="input-group">
            <input value="{{ isset($key) ? $key : '' }}" name="key" type="text" class="form-control mr-3" placeholder="Đơn hàng...">
        </div>
        
        <select class="form-control mr-3" name="user_id">
            <option value="">User ...</option>
            @foreach($user as $val)
            <option <?php if(isset($user_id) && $user_id == $val->id){echo "selected";} ?> value="{{$val->id}}">{{$val->name}}</option>
            @endforeach
        </select>

        <select class="form-control mr-3" name="supplier_id">
            <option value="">Nhà cung cấp ...</option>
            @foreach($supplier as $val)
            <option <?php if(isset($supplier_id) && $supplier_id == $val->id){echo "selected";} ?> value="{{$val->id}}">{{$val->name}}</option>
            @endforeach
        </select>

        <input type="text" class="form-control mr-3" name="datefilter" value="{{ isset($datefilter) ? $datefilter : '' }}" placeholder='Created at ...' />
        <select style="width: 100px;" class="form-control mr-3" name="paginate">
            <option <?php if(isset($paginate) && $paginate=='50'){echo "selected";} ?> value="50">50</option>
            <option <?php if(isset($paginate) && $paginate=='100'){echo "selected";} ?> value="100">100</option>
            <option <?php if(isset($paginate) && $paginate=='200'){echo "selected";} ?> value="200">200</option>
        </select>
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit">
                <i class="fas fa-search fa-sm"></i>
            </button>
        </div>
    </form>
    <a href="admin/nhaphang/add"><button class="btn-primary" type="button"><i class="far fa-file"></i> Thêm mới</button></a>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <?php
                    $total = 0;
                    foreach($orders as $order){
                        foreach($order->nhaphang as $val){
                            $total+=$val->total;
                        }
                    }
                ?>
                <h6 class="m-0 font-weight-bold text-primary">Tổng tiền nhập hàng: <span style="color: red">{{ number_format($total) }} đ</span></h6>
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
                @if(count($orders) == 0)
                    <h2 style="color:red">The list is empty !!</h2>
                @else
                <table class="table" >
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Mã ĐH</th>
                            <th>Ngày</th>
                            <th>Nhà cung cấp</th>
                            <th>Số lượng SP</th>
                            <th>Tổng tiền</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->user_id ? $order->user->name : '' }}</td>
                            <td>{{ $order->code }}</td>
                            <td>{{ date("d/m/Y", strtotime($order->date)) }}</td>
                            <td>{{ isset($order->supplier->id)? $order->supplier->name : '' }}</td>
                            <td>{{count($order->nhaphang)}}</td>
                            <td><?php
                                $i=0;
                                foreach ($order->nhaphang as $key => $value) {
                                    $i+=$value->total;
                                }
                                echo number_format($i)." đ";
                            ?></td>
                            <td>
                                <a href="admin/nhaphang/edit/{{$order->id}}"><i class="fas fa-edit" aria-hidden="true"></i>  </a> 
                                <a onClick="javascript:return window.confirm('Bạn muốn xóa sản phẩm này?');" href="admin/nhaphang/deleteorder/{{$order->id}}"> <i class="fas fa-trash-alt"></i>  </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

