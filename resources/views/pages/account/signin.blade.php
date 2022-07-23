@extends('layout.index')

@section('title')  @endsection
@section('description')  @endsection
@section('keywords')  @endsection
@section('robots')  @endsection
@section('url')  @endsection

@section('content')

@include('layout.header_page')

<div class="form-sign" style="background: url(images/slider/notgeneric_bg3.jpg);">
	<div class="form">
		<form id="form1" action="admin/login" class="form-grey-fields form-validate" method="post">
			<input type="hidden" name="_token" value="{{csrf_token()}}" />
			<h3>Chào mừng bạn !</h3>
			<p>Đăng nhập để trải nghiệm tốt.</p>
			<div class="form-group">
				<label class="sr-only">Tài khoản</label>
				<input name="name" placeholder="Tài khoản" class="form-control" type="text" required>
			</div>
			<div class="form-group m-b-5">
				<label class="sr-only">Mật khẩu</label>
				<input name="password" placeholder="Mật khẩu" class="form-control" type="password">
			</div>
			<div class="form-group form-inline text-left m-b-10 ">
				<a class="right" href="resetpassword">
				<p><small>Lấy lại tài khoản hoặc mật khẩu?</small></p>
			</a>
			</div>
			<div class="text-left form-group">
			<button class="btn" type="submit">Đăng nhập</button> <small id="hidden">{{session('Success')}}</small>
			</div>
			<p class="text-left">Bạn chưa có tài khoản? <a href="signup">Đăng ký ngay</a> </p>
		</form>
	</div>
</div>

<style type="text/css">
	#hidden{color: red}
</style>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
    setTimeout(function() {
	    $('#hidden').fadeOut('fast');
	}, 3000);
</script>

@endsection