@extends('admin.layout.index')
@section('news') menu-item-active @endsection
@section('content')
@include('admin.layout.header')
@include('admin.errors.alerts')
<div class="d-sm-flex align-items-center justify-content-between mb-3 flex">
    <h2 class="h3 mb-0 text-gray-800 line-1 size-1-3-rem">Danh sách sản phẩm</h2>
    <a class="add-iteam" href="admin/news/add"><button class="btn-success form-control" type="button"><i class="fa fa-plus" aria-hidden="true"></i> Thêm mới</button></a>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                <ul class="nav nav-pills">
                    <li><a data-toggle="tab" class="nav-link " href="#all">Tất cả</a></li>
                    <li><a data-toggle="tab" class="nav-link active" href="#public">Hiển thị</a></li>
                    <li><a data-toggle="tab" class="nav-link" href="#hidden">Ẩn</a></li>
                </ul>
            </div>
            <div class="card-body mobile-hide">
                <form action="admin/news/search" class="search" method="post"><input type="hidden" name="_token" value="{{csrf_token()}}" />
                    <div class="form-group mr-3">
                        <input value="{{ isset($key) ? $key : '' }}" name="key" type="text" class="form-control mr-3" placeholder="Tên sp...">
                    </div>
                    <div class="form-group mr-3">
                        <select class="form-control mr-3 select2" name="category_id">
                            <option value=""> Tất cả danh mục</option>
                            @foreach($category as $val)
                            <option <?php if(isset($category_id) && $category_id==$val->id){echo "selected";} ?> value="{{$val->id}}">{{$val->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mr-3">
                        <input type="text" class="form-control mr-3" name="datefilter" value="{{ isset($datefilter) ? $datefilter : '' }}" placeholder='Ngày đăng ...' />
                    </div>
                    <div class="form-group mr-3">
                        <select class="form-control mr-3" name="paginate">
                            <option <?php if(isset($paginate) && $paginate=='50'){echo "selected";} ?> value="50">50</option>
                            <option <?php if(isset($paginate) && $paginate=='100'){echo "selected";} ?> value="100">100</option>
                            <option <?php if(isset($paginate) && $paginate=='200'){echo "selected";} ?> value="200">200</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary form-control" type="submit">
                            <i class="fas fa-search fa-sm"></i> Tìm kiếm
                        </button>
                    </div>
                </form>
            </div>
            <div class="tab-content ">
                <div class="tab-pane overflow" id="all">
                    <table class="table">
                        <form method="post" action="admin/news/delete_all"> <input type="hidden" name="_token" value="{{csrf_token()}}" />
                        <thead>
                            <tr>
                                <th style="position: relative; width: 25px;padding-left: 15px">
                                    <label class="container"><input onclick="toggle(this);" type="checkbox" id="checkbox"><span class="checkmark"></span></label>
                                    <button type="submit" onclick="dell()" class="btn btn-danger btn-sm  ml-2 delall"><i class="la la-trash"></i> Dell all</button>
                                </th>
                                <th></th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Category</th>
                                <th>User</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($news as $val)
                            <tr id="articles">
                                <input type="hidden" id="id" value="{{$val->id}}" />
                                <td class="td_checkbox" style="padding-left: 15px;">
                                    <label class="container"><input type="checkbox" name="foo[]" value="{{$val->id}}"><span class="checkmark"></span></label>
                                </td>
                                <td class="thumbnail-img">
                                    {!! isset($val->img) ? '<img data-action="zoom" src="data/news/'.$val->img.'" />' : '<img data-action="zoom" src="'.$val->img2.'" />' !!}
                                </td>
                                <td>
                                    <a href="admin/news/edit/{{$val->id}}">{{$val->name}}</a>
                                </td>
                                <td>
                                    <div class="checkboxes__item">
                                        <label class="checkbox style-e text-none">
                                            <input type="checkbox" <?php if($val->status == 'true'){echo "checked";} ?> type="checkbox" id='status_articles'/>
                                            <div class="checkbox__checkmark"></div>
                                            <div class="checkbox__body"></div>
                                        </label>
                                    </div>
                                </td>
                                <td>{{ isset($val->category->name) ? $val->category->name : '' }}</td>
                                <td>{{ isset($val->user->name) ? $val->user->name : '' }}</td>
                                <td>
                                    <!-- {{date('d/m/Y',strtotime($val->updated_at))}} <br>  -->
                                    <i style="font-size: 14px">{{date('d/m/Y',strtotime($val->created_at))}}</i>
                                </td>
                                <td class="d-flex">
                                    <a href="admin/news/double/{{$val->id}}" class="mr-2"><i class="far fa-copy"></i></a>
                                    <a href="admin/news/edit/{{$val->id}}" class="mr-2"><i class="fas fa-edit" aria-hidden="true"></i></a>
                                    <a onclick="dell()" href="admin/news/delete/{{$val->id}}"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </form>
                    </table>
                </div>
                <div class="tab-pane overflow active" id="public">
                    <table class="table">
                        <form method="post" action="admin/news/delete_all"> <input type="hidden" name="_token" value="{{csrf_token()}}" />
                        <thead>
                            <tr>
                                <th style="position: relative; width: 25px;padding-left: 15px">
                                    <label class="container"><input onclick="toggle(this);" type="checkbox" id="checkbox"><span class="checkmark"></span></label>
                                    <button type="submit" onclick="dell()" class="btn btn-danger btn-sm  ml-2 delall"><i class="la la-trash"></i> Dell all</button>
                                </th>
                                <th></th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Category</th>
                                <th>User</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($news as $val)
                            @if($val->status=='true')
                            <tr id="articles">
                                <input type="hidden" id="id" value="{{$val->id}}" />
                                <td class="td_checkbox" style="padding-left: 15px;">
                                    <label class="container"><input type="checkbox" name="foo[]" value="{{$val->id}}"><span class="checkmark"></span></label>
                                </td>
                                <td class="thumbnail-img">
                                    {!! isset($val->img) ? '<img data-action="zoom" src="data/news/'.$val->img.'" />' : '<img data-action="zoom" src="'.$val->img2.'" />' !!}
                                </td>
                                <td>
                                    <a href="admin/news/edit/{{$val->id}}">{{$val->name}}</a>
                                </td>
                                <td>
                                    <div class="checkboxes__item">
                                        <label class="checkbox style-e text-none">
                                            <input type="checkbox" <?php if($val->status == 'true'){echo "checked";} ?> type="checkbox" id='status_articles'/>
                                            <div class="checkbox__checkmark"></div>
                                            <div class="checkbox__body"></div>
                                        </label>
                                    </div>
                                </td>
                                <td>{{ isset($val->category->name) ? $val->category->name : '' }}</td>
                                <td>{{ isset($val->user->name) ? $val->user->name : '' }}</td>
                                <td>
                                    <!-- {{date('d/m/Y',strtotime($val->updated_at))}} <br>  -->
                                    <i style="font-size: 14px">{{date('d/m/Y',strtotime($val->created_at))}}</i>
                                </td>
                                <td class="d-flex">
                                    <a href="admin/news/double/{{$val->id}}" class="mr-2"><i class="far fa-copy"></i></a>
                                    <a href="admin/news/edit/{{$val->id}}" class="mr-2"><i class="fas fa-edit" aria-hidden="true"></i></a>
                                    <a onclick="dell()" href="admin/news/delete/{{$val->id}}"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                        </form>
                    </table>
                </div>
                <div class="tab-pane overflow" id="hidden">
                    <table class="table">
                        <form method="post" action="admin/news/delete_all"> <input type="hidden" name="_token" value="{{csrf_token()}}" />
                        <thead>
                            <tr>
                                <th style="position: relative; width: 25px;padding-left: 15px">
                                    <label class="container"><input onclick="toggle(this);" type="checkbox" id="checkbox"><span class="checkmark"></span></label>
                                    <button type="submit" onclick="dell()" class="btn btn-danger btn-sm  ml-2 delall"><i class="la la-trash"></i> Dell all</button>
                                </th>
                                <th></th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Category</th>
                                <th>User</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($news as $val)
                            @if($val->status!='true')
                            <tr id="articles">
                                <input type="hidden" id="id" value="{{$val->id}}" />
                                <td class="td_checkbox" style="padding-left: 15px;">
                                    <label class="container"><input type="checkbox" name="foo[]" value="{{$val->id}}"><span class="checkmark"></span></label>
                                </td>
                                <td class="thumbnail-img">
                                    {!! isset($val->img) ? '<img data-action="zoom" src="data/news/'.$val->img.'" />' : '<img data-action="zoom" src="'.$val->img2.'" />' !!}
                                </td>
                                <td>
                                    <a href="admin/news/edit/{{$val->id}}">{{$val->name}}</a>
                                </td>
                                <td>
                                    <div class="checkboxes__item">
                                        <label class="checkbox style-e text-none">
                                            <input type="checkbox" <?php if($val->status == 'true'){echo "checked";} ?> type="checkbox" id='status_articles'/>
                                            <div class="checkbox__checkmark"></div>
                                            <div class="checkbox__body"></div>
                                        </label>
                                    </div>
                                </td>
                                <td>{{ isset($val->category->name) ? $val->category->name : '' }}</td>
                                <td>{{ isset($val->user->name) ? $val->user->name : '' }}</td>
                                <td>
                                    <!-- {{date('d/m/Y',strtotime($val->updated_at))}} <br>  -->
                                    <i style="font-size: 14px">{{date('d/m/Y',strtotime($val->created_at))}}</i>
                                </td>
                                <td class="d-flex">
                                    <a href="admin/news/double/{{$val->id}}" class="mr-2"><i class="far fa-copy"></i></a>
                                    <a href="admin/news/edit/{{$val->id}}" class="mr-2"><i class="fas fa-edit" aria-hidden="true"></i></a>
                                    <a onclick="dell()" href="admin/news/delete/{{$val->id}}"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Thêm link báo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="admin/news/addflast"><input type="hidden" name="_token" value="{{csrf_token()}}" />
      <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Link:</label>
            <input type="text" name="link" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Category:</label>
            <select name="cat_id" class="form-control">
                @foreach($category as $val)
                <option value="{{$val->id}}">{{$val->name}}</option>
                @endforeach
            </select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>


@endsection