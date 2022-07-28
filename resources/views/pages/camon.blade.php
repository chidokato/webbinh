@extends('layout.index')

@section('css')
<link href="frontend/css/bootstrap.min.css" rel="stylesheet">
<link href="frontend/css/fonts.css" rel="stylesheet">
<link href="frontend/css/common.css" rel="stylesheet">
<link href="frontend/css/header.css" rel="stylesheet">
<link href="frontend/css/footer.css" rel="stylesheet">
<link href="frontend/css/widget.css" rel="stylesheet">
<link href="frontend/css/card.css" rel="stylesheet">
<link href="frontend/css/swiper-bundle.min.css" rel="stylesheet">
@endsection
@section('content')

<div class="cover" style="background-image: url(frontend/images/sub-header.jpg);" >
	<div class="container">
		<hr>
		<h1>Đăng ký nhận báo giá thành công</h1>
		<p></p>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{asset('')}}"></a></li>
			</ol>
		</nav>
	</div>
</div>

<!------------------- CARD ------------------->

<!------------------- END CARD ------------------->

@endsection

@section('script')
<script src="frontend/js/bootstrap.bundle.min.js"></script>
<script src="frontend/js/swiper-bundle.min.js"></script>
<script src="frontend/js/custom.js"></script>

@endsection