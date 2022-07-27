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
<link href="frontend/css/widget.css" rel="stylesheet">
<link href="frontend/css/card.css" rel="stylesheet">
<link href="frontend/css/swiper-bundle.min.css" rel="stylesheet">
@endsection
@section('content')

<div class="cover" style="background-image: url(frontend/images/sub-header.jpg);" >
	<div class="container">
		<hr>
		<h1>{{$category->name}}</h1>
		<p>{!! $category->detail !!}</p>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{asset('')}}">Trang chủ</a></li>
				<li class="breadcrumb-item active" aria-current="page">{{$category->name}}</li>
			</ol>
		</nav>
	</div>
</div>

<!------------------- CARD ------------------->
<section class="card-grid news-sec">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<div class="content">
					<h2>Thông tin</h2>
				</div>
				<h3 class="title-contact">VĂN PHÒNG VIỆT NAM: CÔNG TY TNHH DS TECH VINA</h3>
				<div class="rows-contact">
					<div class="images"><img src="{{asset('')}}frontend/images/vitri.png"></div>
					<div class="input-contact">
						<h4>Địa chỉ</h4>
						<p>Khu Đồng Trại, xã Phượng Mao, Huyện Quế Võ, Tỉnh Bắc Ninh, Việt Nam</p>
					</div>
				</div>
				<div class="rows-contact">
					<div class="images"><img src="{{asset('')}}frontend/images/vitri.png"></div>
					<div class="input-contact">
						<h4>Địa chỉ</h4>
						<p>Khu Đồng Trại, xã Phượng Mao, Huyện Quế Võ, Tỉnh Bắc Ninh, Việt Nam</p>
					</div>
				</div>
				<div class="rows-contact">
					<div class="images"><img src="{{asset('')}}frontend/images/vitri.png"></div>
					<div class="input-contact">
						<h4>Địa chỉ</h4>
						<p>Khu Đồng Trại, xã Phượng Mao, Huyện Quế Võ, Tỉnh Bắc Ninh, Việt Nam</p>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="row">
					<div class="content">
						<h2>Gửi liên hệ</h2>
					</div>
                    <form class="lienhe">
                    	<div class="col-md-12">
	                        <div class="form-group">
	                            <label>Họ và Tên</label> 
	                            <input name="name" placeholder="Họ và Tên" type="text" class="form-control">
	                        </div>
	                    </div>
	                    <div class="col-md-12">
	                        <div class="form-group">
	                            <label>Địa chỉ email</label> 
	                            <input name="name" placeholder="Địa chỉ email" type="text" class="form-control">
	                        </div>
	                    </div>
	                    <div class="col-md-12">
	                        <div class="form-group">
	                            <label>Số điện thoại</label> 
	                            <input name="name" placeholder="Số điện thoại" type="text" class="form-control">
	                        </div>
	                    </div>
	                    <div class="col-md-12">
	                        <div class="form-group">
	                            <label>Nội dung</label> 
	                            <textarea class="form-control" placeholder="Nội dung" rows="5"></textarea>
	                        </div>
	                    </div>
	                    <button>Gửi đi</button>
                    </form>
                    
                </div>
			</div>
		</div>
	</div>
</section>
<!------------------- END CARD ------------------->

@endsection

@section('script')
<script src="frontend/js/bootstrap.bundle.min.js"></script>
<script src="frontend/js/swiper-bundle.min.js"></script>
<script src="frontend/js/custom.js"></script>

@endsection