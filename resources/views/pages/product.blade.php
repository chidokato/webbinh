@extends('layout.index')

@section('title'){{ isset($category->seo->title) ? $category->seo->title : '' }}@endsection
@section('description'){{ isset($category->seo->description)? $category->seo->description:'' }}@endsection
@section('keywords'){{ isset($category->seo->keywords)? $category->seo->keywords:'' }}@endsection
@section('robots'){{ isset($category->seo->robot) && $category->seo->robot == 0 ? 'index, follow' : 'noindex, nofollow' }}@endsection
@section('url'){{asset('')}}{{ isset($category['slug'])?$category['slug']:'' }}@endsection
@section('css')
<link href="frontend/css/bootstrap.min.css" rel="stylesheet">
<link href="frontend/css/fonts.css" rel="stylesheet">
<link href="frontend/css/common.css" rel="stylesheet">
<link href="frontend/css/header.css" rel="stylesheet">
<link href="frontend/css/footer.css" rel="stylesheet">
<link href="frontend/css/form.css" rel="stylesheet">
<link href="frontend/css/widget.css" rel="stylesheet">
<link href="frontend/css/sort.css" rel="stylesheet">
<link href="frontend/css/card.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<?php use App\district; ?>
<!------------------- FILTER SEARCH ------------------->
<section class="sec-fiter-search floating-label">
	<div class="container">
		<div data-bs-toggle="button" class="d-md-none"><button type="button" class="btn btn-circle btn-toggle"><span class="icon-search"></span></button></div>
		<form action="search" type="{{ url('/search') }}" method="GET">
			<div class="row g-3 justify-content-lg-end">
				<div class="col-lg-4">
					<div class="input-group search-input">
						<span class="input-group-text"><i class="icon-search"></i></span>
						<input name="name" value="{{ isset($key_name)? $key_name : '' }}" type="text" class="form-control" placeholder="Nhập từ khóa tìm kiếm">
					</div>
				</div>
				<div class="col-lg-8">
					<div class="row g-3 flex-search search-cat">
						<div class="col-lg">
							<div class="form-floating">
								<select name="key_category" class="form-select select2">
									<option value="">Tất cả</option>
								  	@foreach($cat_pro as $val)
									<option <?php if(isset($key_category) && $key_category == $val->slug){ echo 'selected'; } ?> value="{{$val->slug}}">{{$val->name}}</option>
									@endforeach
								</select>
								<label for="floatingSelectType">Hình thức</label>
							  </div>
						</div>
						<div class="col-lg">
							<div class="form-floating">
								<select name="key_province" class="form-select select2" id="province">
								  <option value="">Tất cả</option>
								  @foreach($province as $val)
								  <option <?php if(isset($key_province) && $key_province==$val->id){ echo 'selected'; } ?> value="{{$val->id}}">{{$val->name}}</option>
								  @endforeach
								</select>
								<label for="floatingSelectGrid">Tỉnh/Thành</label>
							  </div>
						</div>
						<div class="col-lg">
							<div class="form-floating">
								<select name="key_district" class="form-select select2" id="district">
								  <option value="">Tất cả</option>
								  @if(isset($key_province))
								  <?php $district = district::where('province_id',$key_province)->get(); ?>
								  @foreach($district as $val)
								  <option <?php if(isset($key_district) && $key_district==$val->id){ echo 'selected'; } ?> value="{{$val->id}}">{{$val->name}}</option>
								  @endforeach
								  @endif
								</select>
								<label for="floatingSelectGrid">Quận/Huyện</label>
							  </div>
						</div>
						<!-- <div class="col-lg">
							<div class="form-floating">
								<select name="key_price" class="form-select select2" id="floatingSelectWard">
								  	<option value="">Tất cả</option>
								</select>
								<label for="floatingSelectGrid">Giá tiền</label>
							  </div>
						</div> -->
						<div class="col-lg-2"><button type="submit" class="btn btn-circle"><i class="icon-search"></i> Tìm Kiếm</button></div>
					</div>
				</div>
			</div>
		</form>
	</div>
	<!-- <button class="btn toggle-nv d-none d-md-flex" type="button" data-bs-toggle="button">
		<i class="icon-next"></i>
	</button> -->
	<!-- <div class="navbar-vertical d-none d-md-flex scrollbar">
		<div class="nv-header">
			<a class="navbar-brand" href="#"><img src="images/lg-hd.svg" alt="" class="mw-100"></a>
			<ul>
				<li class="nav-item nav-icon notification">
					<a class="nav-link message" href="#" id=""><i class="icon-bell"></i><span class="counter">2</span></a>
				</li>
				<li class="nav-item nav-icon">
					<a class="nav-link" href="#"><i class="icon-user"></i></a>
				</li>
			</ul>
		</div>
		<div class="align-self-center">
			<div class="cta-btn il">
				<a class="nav-link" href="#"><span class="cta-ico"><i class="icon-new"></i></span><span class="cta-text">Đăng tin</span></a>
			</div>
		</div>
		<div class="nv-body">
			<ul class="navbar-nav mb-lg-0">
				<li class="nav-item">
					<a class="nav-link" href="homepage.htm"><i class="icon-home"></i></a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="sales.htm">Mua bán</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="rents.htm">Cho thuê</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="projects.htm">Dự án</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="reviews.htm">Review 4 phương</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link" href="news.htm">Tin tức</a>
					<a class="expand dropdown-toggle" href="#" data-bs-toggle="dropdown"></a>
					<div class="dropdown-menu">
						<ul>
							<li><a href="#" class="submenu-link"><i class="icon-next me-2"></i>Tin phong thủy</a></li>
							<li><a href="#" class="submenu-link"><i class="icon-next me-2"></i>Thẩm định giá</a></li>
							<li><a href="#" class="submenu-link"><i class="icon-next me-2"></i>Dịch vụ công chứng</a></li>
							<li><a href="#" class="submenu-link"><i class="icon-next me-2"></i>Quy hoạch đô thị</a></li>
							<li><a href="#" class="submenu-link"><i class="icon-next me-2"></i>Thẩm định giá</a></li>
							<li><a href="#" class="submenu-link"><i class="icon-next me-2"></i>Dịch vụ công chứng</a></li>
							<li><a href="#" class="submenu-link"><i class="icon-next me-2"></i>Quy hoạch đô thị</a></li>
						</ul>
					</div>
				<li class="nav-item">
					<a class="nav-link" href="brokers.htm">Nhà môi giới</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="agents.htm">Đại lý</a>
				</li>
			</ul>
		</div>
	</div> -->
</section>
<!------------------- END: FILTER SEARCH ------------------->

<!------------------- BREADCRUMB ------------------->
<section class="sec-breadcrumb">
	<div class="container">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
			<li class="breadcrumb-item active" aria-current="page">Tin tức</li>
			</ol>
		</nav>
	</div>
</section>
<!------------------- END: BREADCRUMB ------------------->


<!------------------- CARD ------------------->
<section class="card-grid sales-sec list-tindang">
	<div class="container">
		<h1 class="title-subpage">{{ isset($category->name)? $category->name:'' }}</h1>
		<div class="row">
			<div class="col-lg-9">
				<div class="sort-box">
					<span>có <span class="text-main font-weight-semibold">1.000</span> sản phẩm</span>
					<div class="sort-ct">
						<!-- <div class="dropdown">
							<a class="btn ripple-effect dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
								<span>Hiển thị: Tất cả <i class="icon-down ms-2"></i></span>
							</a>
							<ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuLink">
								<li><a class="dropdown-item checked" href="#">Tất cả</a></li>
								<li><a class="dropdown-item" href="#">Chung cư</a></li>
								<li><a class="dropdown-item" href="#">Biệt thự - Liền kề</a></li>
							</ul>
						</div> -->
						<button type="button" class="btn setting-view hor-view " onclick="horView()"><i class="icon-menu"></i></button>
						<button type="button" class="btn setting-view grid-view actived" onclick="gridView()"><i class="icon-grid"></i></button>
					</div>
				</div>
				<div class="row row-cols-2 row-cols-md-3 g-4 grid-view" id="show-setting">
					@if(count($product)>0)
						@foreach($product as $val)
						<div class="col">
							<div class="card card-s card-s4">
								<!-- <span class="hot"><img src="frontend/images/new-label.png"></span> -->
								<a href="{{$val->category->slug}}/{{$val->slug}}">
									<span><img src="frontend/images/space-3.gif" class="card-img-top" style="background-image: url('data/product/300/{{$val->img}}');" alt="..."></span>
								</a>
								<div class="card-body">
									<div class="card-body-wrap">
										<h5 class="card-title"><a href="{{$val->category->slug}}/{{$val->slug}}" class="text-truncate">{{$val->name}}</a></h5>
										<div class="card-info">
											<span><i class="icon-location me-2"></i>{{ isset($val->product->district->name)? $val->product->district->name.', ' : '' }}{{ isset($val->product->province->name)? $val->product->province->name : '' }}</span>
										</div>
										<p class="mb-0 text-truncate-set text-truncate-set-2">Chính chủ cần chuyển nhượng gấp căn 2 ngủ diện tích thông thủy 78m2 full đồ, khách mua chỉ cần dọn quần áo đến có thể ở ngay</p>
									</div>
									<div class="card-footer">
										<div class="card-price">Giá: <span class="current-price">{{ isset($val->product->price)? $val->product->price:'' }} tỷ</span><span class="old-price">5,6 tỷ</span></div>
									</div>
								</div>
							</div>
						</div>
						@endforeach
					@endif
				</div>
				<div class="load-more text-center mt-4 pt-2">
					<div class="cta-btn ir">
						<a class="" href="#"><span class="cta-text font-weight-semibold">Xem thêm</span><span class="cta-ico"><i class="icon-down"></i></span></a>
					</div>
				</div>
			</div>
			<div class="col-lg-3 d-none d-lg-block">
				<div class="widget widget-list mb-3">
					<h4><span>Biểu đồ giá</span></h4>
					<ul>
						<li><a href="#"><i class="icon-next me-2"></i>Đường Ngụy Như Kontum</a></li>
					</ul>
				</div>

				<div class="widget widget-list widget-hightlight mb-3">
					<h4><span>Sản phẩm bán nhiều</span></h4>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="" id="flexCheck1">
						<label class="form-check-label" for="flexCheck1">
							Quận Hai Bà Trưng (1.000)
						</label>
					  </div>
				</div>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="frontend/js/select2.min.js"></script>
<script src="frontend/js/select2-searchInputPlaceholder.js"></script>

<!------------------- SLIDER ON MOBILE ------------------->

<script>
	function gridView() {
		document.querySelector('.grid-view').classList.add("actived")
		document.querySelector('.hor-view').classList.remove("actived")
		document.querySelector('#show-setting').classList.remove('row-cols-2', 'row-cols-md-1', 'horizontal-view')
		document.querySelector('#show-setting').classList.add('row-cols-2', 'row-cols-md-3', 'grid-view')
	}
	function horView() {
		document.querySelector('.hor-view').classList.add("actived")
		document.querySelector('.grid-view').classList.remove("actived")
		document.querySelector('#show-setting').classList.add('row-cols-2', 'row-cols-md-1', 'horizontal-view')
		document.querySelector('#show-setting').classList.remove('row-cols-2', 'row-cols-md-3', 'grid-view')
	}

	// Notification & Account Nav Vertical Click
	var testNoti = document.getElementById('review-4-phuong');
		toggleFloatingMenuClose.onclick = function() {
			var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
			var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
				return new bootstrap.Dropdown(dropdownToggleEl)
			})
		}
</script>
<script>
	$('.select2').select2({
		searchInputPlaceholder: "Tìm danh mục",
	});
	// $('.select2-inner-dropdown').select2({ 
	// 	searchInputPlaceholder: "Nhập từ khóa",
	// 	dropdownParent: $('.form-more .dropdown-menu') 
	// });
</script>
<script type="text/javascript">
	$(document).ready(function(){
	    $("#province").change(function(){
	        var id = $(this).val();
	        $.get("ajax/change_province/"+id,function(data){
	            $("#district").html(data);
	        });
	    });
	});
</script>
@endsection