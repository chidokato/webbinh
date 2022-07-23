@extends('admin.layout.index')
@section('product') menu-item-active @endsection
@section('content')
<?php use App\articles; ?>
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow fixed">
    <button type="button" id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3"><i class="fa fa-bars"></i></button>
    <ul class="navbar-nav ">
        <li class="nav-item"> <a class="nav-link line-1" href="admin/dashboard" ><i class="fa fa-chevron-left" aria-hidden="true"></i> <span class="mobile-hide">Quay lại trang trước</span> </a> </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link" target="_blank" href="{{asset('')}}" >
                <i class="fas fa-external-link-alt mr-2"></i> Trang chủ
            </a>
        </li>
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle " href="#" id="searchDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small"
                            placeholder="Search for..." aria-label="Search"
                            aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>
        <div class="topbar-divider d-none d-sm-block"></div>
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::User()->your_name}}</span>
                <img class="img-profile rounded-circle" src="data/user/{{Auth::User()->avatar}}">
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href="admin/user/profile/{{Auth::User()->id}}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Trang cá nhân
                </a>
                <a class="dropdown-item" href="admin/user/edit/{{Auth::User()->id}}">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Chỉnh sửa
                </a>
                <a class="dropdown-item" href="admin/user/alerts/{{Auth::User()->id}}">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    Thông báo
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                </a>
                <!-- <a class="dropdown-item" href="admin/logout" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a> -->
            </div>
        </li>
    </ul>
</nav>

<div class="row">
    <div class="col-md-8">
        <div class="card shadow mb-2">
            <div class="card-body ">
                <div class="row-iteam">
                    <div class="images">
                        <img src="data/news/{{$articles->img}}">
                    </div>
                    <div class="info">
                        <div class="profile">
                            <img class="avatar" src="data/user/{{$articles->user->avatar}}">                            
                            <div class="name">
                                <h3>{{$articles->user->your_name}}</h3>
                                <?php $count = articles::where('user_id',$articles->user->id)->count(); ?>
                                <p>{{ $count }} sản phẩm</p>
                            </div>
                        </div>
                        <div class="chinhanh">Chi nhánh: {{$articles->user->option->name}} <br><i class="fa fa-phone" aria-hidden="true"></i>
 {{$articles->user->phone}} </div>
                    </div>
                    <h1>{{$articles->name}}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="download">
                    @foreach($articles->section as $val)
                    <a target="_blank" href="{{$val->name}}"><button class="btn-success form-control">Download <i class="fa fa-download" aria-hidden="true"></i></button></a>
                    @endforeach

                    <h3>File: {{$articles->category->name}}</h3>
                </div>
            </div>
        </div>
    </div>
</div>


  <div class="row">
    <div class="col-md-12">
        @foreach($option as $val)
        @if(in_array($val->sku, explode(',',$articles->option_id)))
        <div class="card shadow mb-2">  
            <div class="card-body ">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">{{$val->name}}</h6>
                </div>
            </div>
            <div class="card-body sub-iteam">
                <?php $articles_lists = articles::where('option_id','like',"%$val->sku%")->whereNotIn('id', [$articles->id])->get(); ?>
                <div class="row">
                    @foreach($articles_lists as $articles_list)
                    <div class="col-md-3">
                        <div class="row-iteam">
                            <a href="admin/dashboard/{{$articles_list->id}}">
                                <div class="images">
                                    <img src="data/news/{{$articles_list->img}}">
                                </div>
                                <h2 class="line-2">{{$articles_list->name}}</h2>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>



<style type="text/css">
    .download a:hover{ text-decoration: unset; }
    .download button{ margin-bottom: 10px; color: #fff; height: 56px; }
    .download h3{ font-size: 1.3rem; margin-top: 40px; color: #15213b; }

    .row-iteam h1{ font-weight: bold; font-size: 1.3rem; color: #15213b;}
    .row-iteam .images{ text-align: center; background: #eee;padding: 20px;background: url(images/bg.png); border-radius: 5px; }
    .row-iteam .images img{ max-height: 500px; max-width: 100%; margin: 0 auto;    box-shadow: 6px 6px 13px 0px #858796; border-radius: 6px; }
    .row-iteam .info { margin-top: 20px; display: flex; align-items: center;justify-content: space-between;}
    .row-iteam .info .chinhanh { font-weight: bold;  }
    .row-iteam .info h3{ font-size: 1.4rem; text-align: left; }
    .profile{ display: flex; margin-bottom: 20px; }
    .profile .avatar{ width: 50px; height: 50px; margin-right: 20px; border-radius: 100px; }
    .profile .name h3{ font-size: 1.2rem; font-weight: bold; color: #15213b; margin-top: 5px; margin-bottom: 0; }
    .profile .name p{ margin-bottom: 0; }
    .sub-iteam .images{ padding: 10px; }
    .sub-iteam .images img{ max-height: 200px; }
    .sub-iteam h2{ color: #15213b; font-size: 1.2rem; margin-top: 10px; }
    .sub-iteam a:hover{ text-decoration: unset; }
    .line-2{-webkit-line-clamp: 2;display: -webkit-box !important;-webkit-box-orient: vertical;overflow: hidden;}
</style>

@endsection
@section('function')

@endsection

