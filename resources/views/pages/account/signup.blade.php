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
		<form id="form2" action="registration" class="form-grey-fields form-validate" method="post">
			<input type="hidden" name="_token" value="{{csrf_token()}}" />
			<h3>Đăng ký thành viên !</h3>
			<p>Hoàn toàn miễn phí.</p>
			<div class="form-group">
				<label class="sr-only">Tên đăng nhập <span>*</span></label>
				<input name="name" placeholder="Tài khoản" class="form-control" type="text">
			</div>
			<div class="form-group">
				<label class="sr-only">Mật khẩu <span>*</span></label>
				<input name="password" placeholder="Mật khẩu" class="form-control" type="password">
			</div>
			<div class="form-group">
				<label class="sr-only">Nhập lại mật khẩu <span>*</span></label>
				<input name="passwordagain" placeholder="Nhập lại mật khẩu" class="form-control" type="password">
			</div>
			<div class="form-group">
				<label class="sr-only">Email</label>
				<input name="email" placeholder="Email" class="form-control" type="text">
			</div>
			<hr>
			<div class="form-group">
				<label class="sr-only">Họ & tên</label>
				<input name="your_name" placeholder="Họ & tên" class="form-control" type="text">
			</div>
			<div class="form-group">
				<label class="sr-only">Địa chỉ</label>
				<input name="address" placeholder="Địa chỉ" class="form-control" type="text">
			</div>
			<div class="form-group">
				<label class="sr-only">Số điện thoại</label>
				<input name="phone" placeholder="Số điện thoại" class="form-control" type="text">
			</div>
			
			<div class="text-left form-group">
			<button class="btn" type="submit">Đăng ký</button>
			</div>
			<p class="text-left">Bạn đã có tài khoản? <a href="signin">Đăng nhập</a></p>
		</form>
	</div>
</div>

@endsection