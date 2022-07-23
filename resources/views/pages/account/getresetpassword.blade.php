@extends('layout.index')

@section('title')  @endsection
@section('description')  @endsection
@section('keywords')  @endsection
@section('robots')  @endsection
@section('url')  @endsection

@section('content')

@include('layout.header_page')
<style type="text/css">
	#hidden{margin-left: 20px;}
</style>
<div class="form-sign" style="background: url(images/slider/notgeneric_bg3.jpg);">
	<div class="form">
		<form action="resetacconut" class="form-grey-fields" method="post">
			<input type="hidden" name="_token" value="{{csrf_token()}}" />
			<h3>Đặt lại tài khoản !</h3>
			<p>Vui lòng check thêm trong hộp thư spam.</p>
			<div class="form-group">
				<label class="sr-only">Nhập email</label>
				<input name="email" placeholder="Nhập email" class="form-control" type="text">
			</div>
			
			<div class="text-left form-group">
				<button class="btn" type="submit">Gửi đi</button> <span id="hidden">{{session('Success')}}</span>
			</div>
			<p class="text-left">Bạn đã có tài khoản? <a href="signin">Đăng nhập</a></p>
		</form>
	</div>
</div>



<script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
    setTimeout(function() {
	    $('#hidden').fadeOut('fast');
	}, 3000); // <-- time in milliseconds
</script>


@endsection