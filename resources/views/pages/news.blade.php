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
						<div class="content">
							{!! $category->content !!}
						</div>
						<div class="row row-cols-2 row-cols-lg-3 g-3 g-lg-3 grid-view" style="margin-top: 0px">
							@foreach($articles as $val)
							<div class="col" style="margin-top: 0px; margin-bottom: 20px;">
								<div class="row-news">
									<a href="{{$val->category->slug}}/{{$val->slug}}">
										<span><img src="frontend/images/space-3.gif" class="card-img-top thumb" style="background-image: url('data/news/{{$val->img}}');" alt="{{$val->name}}"></span>
									</a>
									<div class="card-body-wrap">
										<h3 class=""><a href="{{$val->category->slug}}/{{$val->slug}}" class="text-truncate-set text-truncate-set-2" style="display: -webkit-box;">{{$val->name}}</a></h3>
										<p class="text-truncate-set text-truncate-set-2">{{$val->detail}}</p>
									</div>
								</div>
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

@endsection