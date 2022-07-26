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
				<li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
				<li class="breadcrumb-item active" aria-current="page">{{$category->name}}</li>
			</ol>
		</nav>
	</div>
</div>

<!------------------- CARD ------------------->
<section class="card-grid news-sec">
	<div class="container">
		
		<div class="row">
			<div class="col-lg-3 d-none d-lg-block">

				<div class="widget widget-list mb-3">
					<h4><span>Nội dung</span></h4>
					<ul>
						@foreach($cat_new as $val)
						<li><a href="{{$val->slug}}"><i class="icon-next me-2"></i>{{$val->name}}</a></li>
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
						</div>

						@foreach($articles as $key => $val)
						@if($key==0)
						<div class="col-md-8">
							<a class="card-overlay outline-effect" href="{{ isset($val->category->slug)?$val->category->slug:'' }}/{{$val->slug}}">
								<span class="card-overlay-img"><img src="frontend/images/space-4.gif" alt="" class="w-100" style="background-image: url('data/news/{{$val->img}}');"></span>
								<div class="card-overlay-body">
									<div class="card-overlay-body-wrap">
										<div class="time-box">
											<span>{{date('d/m',strtotime($val->created_at))}}</span>
											<span><i class="icon-time me-1"></i>{{date('Y',strtotime($val->created_at))}}</span>
										</div>
										<h2 class="card-title text-truncate-set text-truncate-set-2">{{$val->name}}</h2>
									</div>
								</div>
							</a>
						</div>
						@endif
						@endforeach
						<div class="col-md-4">
							<div class="card-overlay-flex">
								@foreach($articles as $key => $val)
								@if($key==1)
								<a class="card-overlay card-overlay-sm outline-effect" href="{{isset($val->category->slug)?$val->category->slug:''}}/{{$val->slug}}">
									<span class="card-overlay-img"><img src="frontend/images/space-4.gif" alt="" class="w-100" style="background-image: url('data/news/{{$val->img}}');"></span>
									<div class="card-overlay-body">
										<div class="card-overlay-body-wrap">
											<div class="time-box">
												<span>{{date('d/m',strtotime($val->created_at))}}</span>
												<span><i class="icon-time me-1"></i>{{date('Y',strtotime($val->created_at))}}</span>
											</div>
											<h2 class="card-title text-truncate-set text-truncate-set-2">{{$val->name}}</h2>
										</div>
									</div>
								</a>
								@endif
								@if($key==2)
								<a class="card-overlay card-overlay-sm outline-effect" href="{{isset($val->category->slug)?$val->category->slug:''}}/{{$val->slug}}">
									<span class="card-overlay-img"><img src="frontend/images/space-4.gif" alt="" class="w-100" style="background-image: url('data/news/{{$val->img}}');"></span>
									<div class="card-overlay-body">
										<div class="card-overlay-body-wrap">
											<div class="time-box">
												<span>{{date('d/m',strtotime($val->created_at))}}</span>
												<span><i class="icon-time me-1"></i>{{date('Y',strtotime($val->created_at))}}</span>
											</div>
											<h2 class="card-title text-truncate-set text-truncate-set-2">{{$val->name}}</h2>
										</div>
									</div>
								</a>
								@endif
								@endforeach
							</div>
						</div>
					</div>
				</div>
				<div class="row row-cols-1 g-4 horizontal-view" id="show-setting">
					@foreach($articles as $key => $val)
					@if($key>2)
					<div class="col">
						<div class="card card-s card-s4">
							<a href="{{isset($val->category->slug)?$val->category->slug:''}}/{{$val->slug}}">
								<span><img src="frontend/images/space-3.gif" class="card-img-top" style="background-image: url('data/news/{{$val->img}}');" alt="..."></span>
							</a>
							<div class="card-body">
								<div class="card-body-wrap">
									<h2 class="card-title"><a href="{{isset($val->category->slug)?$val->category->slug:''}}/{{$val->slug}}">{{$val->name}}</a></h2>
									<div class="card-info">
										<span><i class="icon-time me-2"></i>{{date('d/m/Y',strtotime($val->created_at))}}</span>
										<span><i class="icon-user me-2"></i>{{$val->user->name}}</span>
									</div>
									<p class="mb-0 text-truncate-set text-truncate-set-2">{{$val->detail}}</p>
								</div>
							</div>
						</div>
					</div>
					@endif
					@endforeach
				</div>

			</div>
			
		</div>
	</div>
</section>
<!------------------- END CARD ------------------->

@endsection

@section('script')
<script src="frontend/js/bootstrap.bundle.min.js"></script>
<script src="frontend/js/custom.js"></script>
@endsection