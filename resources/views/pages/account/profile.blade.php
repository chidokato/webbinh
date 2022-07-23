@extends('layout.index')

@section('title')  @endsection
@section('description')  @endsection
@section('keywords')  @endsection
@section('robots')  @endsection
@section('url')  @endsection

@section('content')

@include('layout.header_page')
<div class="form-sign profile" style="background: url(images/slider/notgeneric_bg3.jpg);">
	<div class="form">
		<form action="registration/{{Auth::User()->id}}" class="form-grey-fields" method="post" enctype="multipart/form-data"><input type="hidden" name="_token" value="{{csrf_token()}}" />
			<input type="hidden" name="permission" value="5" />
			<div class="content clearfix">
				<div class="text-left">
					<img src="data/user/{{Auth::User()->avatar}}" class="avatar avatar-lg">
					<input type="file" name="img">
				</div>
				<hr>
				<div class="wizard-content body current" id="wizard1-p-0" role="tabpanel" aria-labelledby="wizard1-h-0" aria-hidden="false" style="">
					<div class="h5 mb-4"></div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="username" class="text-left">Tài khoản</label>
							<div class="input-group">
							<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">@</span>
							</div>
							<input type="text" class="form-control" name="name" value="{{Auth::User()->name}}" placeholder="Tài khoản">
							</div>
						</div>
						<div class="form-group col-md-6">
							<label for="email" class="text-left">Email</label>
							<input type="email" class="form-control" name="email" value="{{Auth::User()->email}}" placeholder="email">
						</div>
					</div>
					
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="username" class="text-left">Họ & Tên</label>
							<input type="text" class="form-control" name="your_name" value="{{Auth::User()->your_name}}" placeholder="Họ & Tên">
						</div>
						<div class="form-group col-md-6">
							<label for="username" class="text-left">Địa chỉ</label>
							<input type="text" class="form-control" name="address" value="{{Auth::User()->address}}" placeholder="Địa chỉ">
						</div>
					</div>
					
					<div class="form-row">
						<div class="form-group col-md-6">
							<label class="text-left" style="padding-left: 20px;"><input class="form-check-input" id="exampleCheck1" type="checkbox"> Thay đổi mật khẩu</label>
							<div class="input-group show-hide-password">
								<input disabled class="form-control pass" name="password" placeholder="Mật khẩu" type="password">
								<div class="input-group-append">
									<span class="input-group-text"><i class="icon-eye-off" aria-hidden="true" style="cursor: pointer;"></i></span>
								</div>
						 	</div>
						</div>
						<div class="form-group col-md-6">
							<label for="password2" class="text-left" style="color: #fff">Nhập lại mật khẩu</label>
							<div class="input-group show-hide-password">
								<input disabled class="form-control pass" name="passwordagain" placeholder="Nhập lại mật khẩu" type="password">
								<div class="input-group-append">
									<span class="input-group-text"><i class="icon-eye-off" aria-hidden="true" style="cursor: pointer;"></i></span>
								</div>
							</div>
						</div>

					</div>
					<div class="text-left" >
						<button type="submit" class="btn">Lưu lại</button> <span id="hidden">{{session('Success')}}</span>
					</div>
				</div>
			</div>
			
		</form>
	</div>
</div>

<style type="text/css">
	#hidden{margin-left: 20px;}
</style>

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
    $(document).ready(function(){
        $('#exampleCheck1').change(function(){
            if ($(this).is(":checked")) {
                $(".pass").removeAttr('disabled');
            }
            else
            {
                $(".pass").attr('disabled','');
            }
        });
    });

    setTimeout(function() {
	    $('#hidden').fadeOut('fast');
	}, 3000); // <-- time in milliseconds
</script>

@endsection