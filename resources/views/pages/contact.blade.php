@extends('layout.index')

@section('title'){{ isset($category->title) ? $category->title : $category->name }}@endsection
@section('description'){{$category->description}}@endsection
@section('keywords'){{$category->keywords}}@endsection
@section('robots'){{ $category->robot == 0 ? 'index, follow' : 'noindex, nofollow' }}@endsection
@section('url'){{asset('').$category['slug']}}@endsection
@section('css')
<link href="frontend/css/bootstrap.min.css" rel="stylesheet">
<link href="frontend/css/fonts.css" rel="stylesheet">
<link href="frontend/css/common.css" rel="stylesheet">
<link href="frontend/css/header.css" rel="stylesheet">
<link href="frontend/css/footer.css" rel="stylesheet">
<link href="frontend/css/contact.css" rel="stylesheet">
@endsection
@section('content')

<!------------------- BREADCRUMB ------------------->
<section class="sec-breadcrumb">
	<div class="container">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
			<li class="breadcrumb-item active" aria-current="page">Liên hệ</li>
			</ol>
		</nav>
	</div>
</section>
<!------------------- END: BREADCRUMB ------------------->

<!------------------- COVER ------------------->
<section class="sec-cover">
	<picture>
		<source media="(min-width: 768px)" srcset="frontend/images/cover-contact.jpg" class="mw-100">
		<img src="frontend/images/space-9.gif" class="w-100 thumb" style="background-image: url(frontend/images/cover-contact.jpg);">
	</picture>
	<div class="container">
		<div class="cover-content cover-footer-wrap">
			<div class="cover-title">
				<h3><span class="cover-title-filled">Liên hệ</span><span class="position-relative">Nhà đất VN</span></h3>
			</div>
			<!-- <p>Trụ sở <b>NHÀ Ở NGAY</b></p> -->

			<div class="cover-ct">
				<div class="container">
					<div class="row row-cols-1 row-cols-md-3 g-4">
						<div class="col">
							<div class="cover-ct-item">
								<div class="cover-ct-item-text">
									<h6>Hotline tư vấn</h6>
									<span class="phone">0919.51.18.81</span>
								</div>
								<span class="cover-ct-item-img"><i class="icon-phone-filled"></i></span>
							</div>
						</div>
						<div class="col">
							<div class="cover-ct-item">
								<div class="cover-ct-item-text">
									<h6>email</h6>
									<span>cskh@nhaongay.vn</span>
								</div>
								<span class="cover-ct-item-img"><i class="icon-mail-filled"></i></span>
							</div>
						</div>
						<div class="col">
							<div class="cover-ct-item">
								<div class="cover-ct-item-text">
									<h6>Địa chỉ văn phòng</h6>
									<span>61 Ngụy Như Kon Tum, Quận Thanh Xuân, Hà Nội</span>
								</div>
								<span class="cover-ct-item-img"><i class="icon-building-filled"></i></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!------------------- END COVER ------------------->

<!------------------- CARD ------------------->
<section class="contact-sec">
	<div class="google-map"><img src="frontend/previews/map.jpg" alt="" class="w-100"></div>
	<div class="contact-title-wrap">
		<div class="container">
			<div class="text-center">
				<div class="primary-title">
					<h3><span class="cover-title-filled">Liên hệ</span><span class="position-relative">Với chúng tôi</span></h3>
				</div>
			</div>
		</div>
	</div>
	<div class="contact-form">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6">
					<form class="row g-3">
						<div class="col-12">
							<div class="form-floating">
								<input type="text" class="form-control" id="yourName" placeholder="Họ tên">
								<label for="yourName">Họ tên</label>
							</div>
						</div>
						<div class="col-12">
							<div class="form-floating">
								<input type="text" class="form-control" id="yourAddress" placeholder="Địa chỉ">
								<label for="yourAddress">Địa chỉ</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-floating">
								<input type="number" class="form-control" id="yourPhone" placeholder="Số điện thoại">
								<label for="yourPhone">Số điện thoại</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-floating">
								<input type="email" class="form-control" id="yourEmail" placeholder="email">
								<label for="yourEmail">Email</label>
							</div>
						</div>
					
						<div class="col-12">
							<div class="form-floating">
								<textarea class="form-control" id="yourContent" placeholder="Nội dung" rows="4"></textarea>
								<label for="yourContent">Nội dung</label>
							</div>
						</div>
					
						<div class="load-more text-center mt-4 pt-2">
							<div class="cta-btn ir">
								<a class="" href="#"><span class="cta-text font-weight-semibold">Gửi thông tin</span><span class="cta-ico"><i class="icon-next"></i></span></a>
							</div>
						</div>
					</form>
			</div>

		</div>
	</div>
</section>
<!------------------- END CARD ------------------->

@endsection

@section('script')
<!------------------- JS core------------------->
<script src="frontend/js/bootstrap.bundle.min.js"></script>
<script src="frontend/js/custom.js"></script>
@endsection