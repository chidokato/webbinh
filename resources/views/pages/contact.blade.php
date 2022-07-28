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
			<div class="col-lg-12">
				<div class="news-hightlight">
					<div class="row">
						<div class="content">
							{!! $category->content !!}
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