<?php use App\menu; ?>
<!------------------- NAVIGATOR ------------------->
<header class="navhome">
	<nav class="navbar navbar-expand-lg navbar-dark" aria-label="Ninth navbar example">
		<div class="container">
		  <a class="navbar-brand logo" href="{{asset('')}}"><img src="{{asset('')}}data/themes/{{$head_logo->img}}" alt="" class="mw-100"></a>
		  <div class="toggle-menu" data-bs-toggle="button">
				<button class="navbar-toggler ico-menu" id="navbarToggler">
					<div>
						<span></span>
						<span></span>
						<span></span>
					</div>
				</button>
			</div>
	
		  <div class="navbar-collapse flex-grow-1" id="navbarsExample07XL">
			<ul class="collapse navbar-nav mb-lg-0">
				<li class="nav-item {{ isset($active) && $active=='' ? 'active':'' }}">
					<a class="nav-link" href="{{asset('')}}">Trang chủ</a>
				</li>
				@foreach($menu as $val)
				<?php $sub_menus = menu::where('classify','Main menu')->where('status','true')->where('parent', $val->id)->orderBy('view','asc')->get(); ?>
				@if(count($sub_menus) > 0)
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="{{asset('')}}{{$val->slug}}" data-bs-toggle="dropdown" onclick="myFunctLink(this)">{{$val->name}}</a>
					<a class="expand dropdown-toggle d-lg-none" href="#" data-bs-toggle="dropdown"></a>
					<div class="dropdown-menu">
						<ul>
							@foreach($sub_menus as $sub_menu)
							<li><a href="{{asset('')}}{{$sub_menu->slug}}" class="submenu-link"><i class="icon-next me-2"></i>{{$sub_menu->name}}</a></li>
							@endforeach
						</ul>
					</div>
				</li>
				@else
				<li class="nav-item {{ isset($active) && $active==$val->slug ? 'active':'' }} ">
					<a class="nav-link" href="{{asset('')}}{{$val->slug}}">{{$val->name}}</a>
				</li>
				@endif
				@endforeach
				<li> <div id="translate_select"></div> </li>
			</ul>
			

		  </div>
		</div>
  	</nav>
</header>
<!------------------- END NAVIGATOR ------------------->