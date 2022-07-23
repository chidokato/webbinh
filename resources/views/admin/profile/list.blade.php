@extends('admin.layout.index')
@section('profile')
class="active"
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            
        </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
@include('admin.errors.alerts')
<!-- /.row -->
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
          Trang cá nhân
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">
        <div class="row">
          <div class="col-md-3">
            <div class="profile_img">
              <div id="crop-avatar">
                <img class="img-responsive avatar-view" src="{{Auth::User()->avatar}}" alt="Avatar" >
              </div>
            </div>
            <h3>{{Auth::User()->name}}</h3>
            <ul class="list-unstyled user_data">
              <li>Email: {{Auth::User()->email}}</li>
            </ul>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-edit m-right-xs"></i> Edit Profile</button>
          </div>
          <div class="col-md-9 col-xs-12">
            @include('admin.layout.tet')
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<form action="admin/profile/edit/{{$profile->id}}" method="POST" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{{csrf_token()}}" />
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
				<h4  class="modal-title text-center" id="myModalLabel">Chỉnh sửa thông tin cá nhân</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="form-group row">
            <label style="text-align: right;" class="control-label col-md-3 col-sm-3 col-xs-12">Name *</label>
          	<div class="col-md-7 col-sm-7 col-xs-10">
            		<input value="{{$profile->name}}" name='name' type="text" placeholder="Name *" class="form-control" />
          	</div>
        	</div>
        	<div class="form-group row">
            <label style="text-align: right;" class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
          	<div class="col-md-7 col-sm-7 col-xs-10">
            		<input disabled value="{{$profile->email}}"  type="text" placeholder="Name *" class="form-control" />
          	</div>
        	</div>
        	<div class="form-group row">
            <label style="text-align: right;" class="control-label col-md-3 col-sm-3 col-xs-12">Avatar</label>
          	<div class="col-md-7 col-sm-7 col-xs-10">
            		<input onclick="BrowseServer();" type="text" name="img" placeholder="click !"  id="image" class="form-control">
          	</div>
          	
        	</div>
				</div>
			</div>
			<div class="modal-footer text-center">
				<button type="submit" class="btn btn-success">Save changes</button>
			</div>
		</div>
	</div>
</div>
</form>


<script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
$(document).ready(function(){
    $("input#clickupdate").blur(function(){
    	// alert('ok');
        var bc = $(this).parents('.suagia').find('input[name="bc"]').val();
        var cn = $(this).parents('.suagia').find('input[name="cn"]').val();
        var da = $(this).parents('.suagia').find('input[name="da"]').val();
        var kc = $(this).parents('.suagia').find('input[name="kc"]').val();
        var tv_id = $(this).parents('.suagia').find('input[name="tv_id"]').val();
        var p_old = $(this).parents('.suagia').find('input[name="p_old"]').val();
        var price = $(this).parents('.suagia').find('input[name="price"]').val(); if(price == ''){ price = 0 }
    	// alert(bc);
        $.ajax({
            url:  'admin/profile/update/'+tv_id,
            type: 'GET',
            cache: false,
            data: {
            	"bc":bc,
            	"cn":cn,
            	"da":da,
            	"kc":kc,
            	"p_old":p_old,
            	"price":price
            },
            success: function(data){
                $('#content').html(data);
            }
        });
    });
});
</script>

@endsection


