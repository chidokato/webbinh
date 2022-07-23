<section class="sec-hero">
	<div class="hero-slider">
		<div class="swiper">
			<div class="swiper-wrapper">
				@foreach($slider as $val)
				<div class="swiper-slide">
					<span style='background-image: url("data/themes/{{$val->img}}")' class="w-100 thumb"></span>
					<div class="slider-info">
						<h3>(주)더블에스테크</h3>
						<p>당사는 고객의 Needs에 따라,</p>
						<p>제품 및 가공 환경에 알맞은 Spindle을 제안하고,</p>
						<p>요청에 따라 제작 및 판매, 수리 합니다.</p>
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
