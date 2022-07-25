@extends('layout.index')

@section('title'){{ isset($head_setting->title) ? $head_setting->title : $head_setting->name }}@endsection
@section('description'){{$head_setting->description}}@endsection
@section('keywords'){{$head_setting->keywords}}@endsection
@section('robots'){{ $head_setting->robot == 0 ? 'index, follow' : 'noindex, nofollow' }}@endsection
@section('url'){{asset('').$head_setting['slug']}}@endsection

@section('css')
<link href="frontend/css/bootstrap.min.css" rel="stylesheet">

<link href="frontend/css/swiper-bundle.min.css" rel="stylesheet">
<link href="frontend/css/fonts.css" rel="stylesheet">
<link href="frontend/css/common.css" rel="stylesheet">
<link href="frontend/css/header.css" rel="stylesheet">
<link href="frontend/css/footer.css" rel="stylesheet">
<link href="frontend/css/sort.css" rel="stylesheet">
<link href="frontend/css/card.css" rel="stylesheet">
<link href="frontend/css/form.css" rel="stylesheet">
<link href="frontend/css/simpleLightbox.css" rel="stylesheet">
<link href="frontend/css/home.css" rel="stylesheet">
@endsection
@section('content')

@foreach($homes as $key => $home)

@if($key==0)

<section class="sec-hero">
	<div class="hero-slider">
		<div class="swiper">
			<div class="swiper-wrapper">
				@foreach($home->section as $val)
				<div class="swiper-slide">
					<span style='background-image: url("data/home/{{$val->img}}")' class="w-100 thumb"></span>
					<div class="slider-info">
						<h3>{{$val->name}}</h3>
						{!! $val->content !!}
					</div>
				</div>
				@endforeach
			</div>
			<div class="swiper-navigator">
				<div class="swiper-pagination"></div>
				<div class="swiper-navigator-btn">
					<div class="swiper-button-prev"><i class="icon-prev-thin"></i></div>
					<div class="swiper-button-next"><i class="icon-next-thin"></i></div>
				</div>
			</div>
		</div>
	</div>
</section>

@elseif($key==1)

<section class="sec-product-hot">
	<div class="container">
		<div class="product-hot-slider">
			<div class="position-relative grid-view">
				<div class="swiper">
					<div class="swiper-wrapper">
						@foreach($home->section as $val)
						<div class="swiper-slide">
							<div class="card card-s card-s4">
								<a href="">
									<span><img src="frontend/images/space-3.gif" class="card-img-top" style="background-image: url('data/home/{{$val->img}}');" alt="..."></span>
								</a>
								<div class="card-body">
									<div class="card-body-wrap">
										<h2 class="card-title"><a href="" class="text-truncate">{{$val->name}}</a></h2>
										<div class="card-info">
											<span><i class="icon-location me-2"></i>
												{!! $val->content !!}
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
				<div class="swiper-button-next"></div>
				<div class="swiper-button-prev"></div>
			</div>
		</div>
	</div>
</section>

@elseif($key==2)

<!------------------- WHY CHOOSE US ------------------->
<section class="sec-why-choose-us">
	<div class="elementor-background-overlay"></div>
	<div class="container">
		<div class="text-center">
			<div class="primary-title pt-md-0">
				<h3>{{ $home->name }}</h3>
				<p>{{ $home->detail }}</p>
			</div>
		</div>
		<div class="row g-0 justify-content-center">
			<div class="col-lg-10">
				<div class="row g-4">
					@foreach($home->section as $val)
					<div class="col-6 col-lg-3">
						<div class="reason-item">
							<div class="reason-item-wrap">
								<span style="text-align: center;">다년간의 경험을 경<br>
									바탕으로 고객 설<br>
									설비의 설비의</span>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</section>

@endif

@endforeach







<!------------------- ESTIMATE ------------------->
<section class="sec-tcg">
	<div class="row g-0">
		<div class="col-lg-6">
			<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d6402.655761566034!2d127.437198!3d36.642562!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x356528f0b96c996f%3A0xca27b8fec2368610!2s134%20Gongdan-ro%2C%20Heungdeok-gu%2C%20Cheongju%2C%20Chungcheongbuk-do%2C%20H%C3%A0n%20Qu%E1%BB%91c!5e0!3m2!1svi!2sus!4v1658237026669!5m2!1svi!2sus" width="100%" height="550" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
		</div>
	</div>
	<div class="container">
		<div class="tcg-content primary-title">
			<h3 class="title-home">Liên hệ ngay</h3>
			<p>본사 : [28576] 충북 청주시 흥덕구 공단로 134, 세중테크노밸리 404호</p>
			<p>TEL : 043-263-3705</p>
			<p>FAX : 043-263-3706</p>
			<p>E-MAIL : 1972sds@hanmail.net</p>
			<p>문의 및 상담 : +82 010-6526-3705｜+82 010-6210-6500</p>
		</div>
	</div>
</section>

@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="frontend/js/bootstrap.bundle.min.js"></script>
<!-- <script src="frontend/js/select2.min.js"></script> -->
<!-- <script src="frontend/js/select2-searchInputPlaceholder.js"></script> -->

<script src="frontend/js/swiper-bundle.min.js"></script>
<script src="frontend/js/simpleLightbox.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
	new SimpleLightbox({elements: '.main-ads-slider a'});
</script>
<script>
        var swiper1 = new Swiper(".broker-slider .swiper", {
            slidesPerView: 2,
            spaceBetween: 20,
            pagination: {
                el: ".broker-slider .swiper-pagination",
                clickable: true,
            },
            // Responsive breakpoints
            breakpoints: {
                // when window width is >= 320px
                320: {
                    slidesPerView: 2,
                    spaceBetween: 20
                },
                // when window width is >= 480px
                768: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                // when window width is >= 640px
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 20,
                    navigation: {
                        nextEl: ".broker-slider .swiper-button-next",
                        prevEl: ".broker-slider .swiper-button-prev",
                    },
                }
            },
        });

        var swiper2 = new Swiper(".agent-partner-slider .swiper", {
            slidesPerView: 2,
            spaceBetween: 20,
            pagination: {
                el: ".agent-partner-slider .swiper-pagination",
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
                        nextEl: ".agent-partner-slider .swiper-button-next",
                        prevEl: ".agent-partner-slider .swiper-button-prev",
                    },
                }
            },
        });

        var swiper3 = new Swiper(".service-slider .swiper", {
            slidesPerView: 2,
            spaceBetween: 0,
            pagination: {
                el: ".agent-partner-slider .swiper-pagination",
                clickable: true,
            },
            // Responsive breakpoints
            breakpoints: {
                // when window width is >= 320px
                320: {
                    slidesPerView: 1,
                    spaceBetween: 0
                },
                // when window width is >= 480px
                768: {
                    slidesPerView: 1,
                    spaceBetween: 0,
                },
                // when window width is >= 640px
                1024: {
                    slidesPerView: 2,
                    spaceBetween: 0,
                }
            },
        });

        var swiper4 = new Swiper(".review-project-content .swiper", {
            slidesPerView: 2,
            spaceBetween: 0,
            pagination: {
                el: ".review-project-content .swiper-pagination",
                clickable: true,
            },
        });

        var swiper5 = new Swiper(".thumb-ads-slider .swiper", {
            spaceBetween: 2,
            lazy: true,
            slidesPerView: "auto",
            freeMode: true,
            watchSlidesProgress: true,
            // autoplay: {
            //   delay: 2500,
            // },
        });
        var swiper6 = new Swiper(".main-ads-slider .swiper", {
            spaceBetween: 0,
            lazy: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            thumbs: {
                swiper: swiper5,
            },
        });

        var swiper7 = new Swiper(".product-hot-slider .swiper", {
			slidesPerView: 3,
			loop: true,
			spaceBetween: 30,
			grabCursor: true,
			centeredSlides: true,
			effect: "coverflow",
			coverflowEffect: {
				rotate: 0,
				stretch: 0,
				scale:.9,
				depth: 0,
				modifier: 1,
				slideShadows : false,
			},
			pagination: {
				el: ".product-hot-slider .swiper-pagination",
				clickable: true,
			},
			// Responsive breakpoints
			breakpoints: {
				// when window width is >= 320px
				320: {
					slidesPerView: 2,
					spaceBetween: 0,
					coverflowEffect: {
						
						depth: 10,
					}
				},
				// when window width is >= 480px
				768: {
					slidesPerView: 2,
					spaceBetween: 0,
				},
				// when window width is >= 640px
				1024: {
					slidesPerView: 3,
					spaceBetween: 0,
					navigation: {
						nextEl: ".product-hot-slider .swiper-button-next",
						prevEl: ".product-hot-slider .swiper-button-prev",
					},
				}
			},	
		});


        var swiper8 = new Swiper(".hero-slider .swiper", {
            spaceBetween: 0,
            effect: "fade",
            lazy: true,
            loop: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".hero-slider .swiper-pagination",
                type: "fraction",
            },
            navigation: {
                nextEl: ".hero-slider .swiper-button-next",
                prevEl: ".hero-slider .swiper-button-prev",
            },
        });
    </script>

<script src="frontend/js/custom.js"></script>
@endsection