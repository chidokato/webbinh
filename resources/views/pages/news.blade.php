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

<style type="text/css">
	
</style>
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
			<!-- <div class="col-lg-3 d-none d-lg-block"> -->
			<div class="col-lg-3 d-lg-block">

				<div class="widget widget-list mb-3 sticky-70">
					<h4><span>{{$category->name}}</span></h4>
					<ul>
						@foreach($sub_cat as $val)
						<li><a class="<?php if($active == $val->slug){ echo "active";} ?>" href="{{$val->slug}}"><i class="icon-next me-2"></i>{{$val->name}}</a></li>
						@endforeach
					</ul>
				</div>
			</div>

			<div class="col-lg-9">
				
				<div class="news-hightlight">
					<div class="row">
						<!-- <h2 class="text-uppercase title-subpage">{{$category->name}}</h2> -->

						<div class="content">
							{!! $category->content !!}

							@foreach($category->articles as $val)
							<div class="row-iteam">
								<h3>{{$val->name}}</h3>
							</div>
							<div class="position-relative broker-slider">
								<div class="swiper">
									<div class="swiper-wrapper">
										@foreach($val->images as $img)
										<div class="swiper-slide">
											<div class="card ">
												<img src="frontend/images/space-2.gif" class="card-img-top thumb" style="background-image: url('data/product/{{$img->img}}');" alt="{{$val->name}}">
											</div>
										</div>
										@endforeach
									</div>
									<div class="swiper-pagination d-lg-none"></div>
								</div>
								<div class="swiper-button-next d-none d-lg-flex"></div>
								<div class="swiper-button-prev d-none d-lg-flex"></div>
							</div>
							@endforeach

						</div>
					</div>
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

<script src="frontend/js/swiper-bundle.min.js"></script>
<script src="frontend/js/simpleLightbox.min.js"></script>

<script>
        var swiper1 = new Swiper(".broker-slider .swiper", {
            slidesPerView: 1,
            spaceBetween: 20,
            pagination: {
                el: ".broker-slider .swiper-pagination",
                clickable: true,
            },
            // Responsive breakpoints
            breakpoints: {
                // when window width is >= 320px
                320: {
                    slidesPerView: 1,
                    spaceBetween: 20
                },
                // when window width is >= 480px
                768: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                // when window width is >= 640px
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                    navigation: {
                        nextEl: ".broker-slider .swiper-button-next",
                        prevEl: ".broker-slider .swiper-button-prev",
                    },
                }
            },
        });

    </script>
@endsection