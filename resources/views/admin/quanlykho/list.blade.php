@extends('admin.layout.index')
@section('quanlykho') menu-item-active @endsection
@section('content')
@include('admin.errors.alerts')
<div class="d-sm-flex align-items-center justify-content-between mb-3">
    <!-- <h1 class="h3 mb-0 text-gray-800">List Category</h1> -->
    <form style="display: flex;" action="admin/category/search" method="post"><input type="hidden" name="_token" value="{{csrf_token()}}" />
        <div class="input-group">
            <input value="{{ isset($key) ? $key : '' }}" name="key" type="text" class="form-control mr-3" placeholder="Name...">
        </div>
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
    <!-- <a href="admin/quanlykho/add"><button class="btn-primary" type="button"><i class="far fa-file"></i> Thêm mới</button></a> -->
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
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
                            
                            <th></th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>User</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Hot</th>
                            <th>View</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($articles as $val)
                        <tr>
                            <td class="thumbnail-img">
                                {!! isset($val->img) ? '<img data-action="zoom" src="data/product/'.$val->img.'" />' : '' !!}
                            </td>
                            <td>
                                {{$val->name}}
                            </td>
                            <td>{{ isset($val->category->name) ? $val->category->name : '' }}</td>
                            <td>{{ isset($val->user->name) ? $val->user->name : '' }}</td>
                            <td>
                                {{date('d/m/Y',strtotime($val->updated_at))}} <!-- <br> <i style="font-size: 14px">{{date('d/m/Y',strtotime($val->created_at))}}</i> -->
                            </td>
                            <td>
                                <input type="checkbox" <?php if($val->status == 'true'){echo "checked";} ?> >
                            </td>
                            <td>22</td>
                            <td></td>
                            <td class="d-flex">
                                <!-- <a target="_blank" href="{{asset('')}}" class="mr-2"><i class="fas fa-external-link-alt"></i></a> -->
                                <!-- <a href="admin/quanlykho/double/{{$val->id}}" class="mr-2"><i class="far fa-copy"></i></a> -->
                                <a href="admin/quanlykho/edit/{{$val->id}}" class="mr-2"><i class="fas fa-edit" aria-hidden="true"></i></a>
                                <!-- <a href="admin/quanlykho/delete/{{$val->id}}"><i class="fas fa-trash-alt"></i></a> -->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection