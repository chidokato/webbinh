@extends('layout.index')

@section('title'){{ isset($articles->title) ? $articles->title : $articles->name }}@endsection
@section('description'){{$articles->description}}@endsection
@section('keywords'){{$articles->keywords}}@endsection
@section('robots'){{ $articles->robot == 0 ? 'index, follow' : 'noindex, nofollow' }}@endsection
@section('url'){{asset('').$articles->category->slug.'/'.$articles->slug}}@endsection

@section('css')
<link href="{{asset('')}}frontend/css/bootstrap.min.css" rel="stylesheet">
<link href="{{asset('')}}frontend/css/swiper-bundle.min.css" rel="stylesheet">
<link href="{{asset('')}}frontend/css/fonts.css" rel="stylesheet">
<link href="{{asset('')}}frontend/css/common.css" rel="stylesheet">
<link href="{{asset('')}}frontend/css/header.css" rel="stylesheet">
<link href="{{asset('')}}frontend/css/footer.css" rel="stylesheet">
<link href="{{asset('')}}frontend/css/widget.css" rel="stylesheet">
<link href="{{asset('')}}frontend/css/card.css" rel="stylesheet">
<link href="{{asset('')}}frontend/css/article.css" rel="stylesheet">
<style type="text/css">
	
#toc{background: #f3f3f347; padding: 7px;	font-size: 14px;	text-align: justify;}
#contents{padding: 0px; }
#toc ul{padding: 0; margin: 0; }
#toc ul li{ list-style:none; padding:0px; margin-bottom: 8px; }
#toc>ul>ul>li{ margin-left: 0px; margin-bottom: 0px; text-align: left; }
#toc>ul>ul>li>ul{}
#toc>ul>ul>li>ul>li{margin-bottom: 0px; position: relative;padding-left: 8px;}
#toc>ul>ul>li>ul>li::before{
    content: '-';
    position: absolute;
    left: 0;
    top: 2px;
}
#toc ul li a{ text-decoration:none; }
#toc ul li a:hover{ color: red }
#toc ul li .active{color: red}
/*#toc ul li{white-space: nowrap; text-overflow: ellipsis; overflow: hidden;}*/
.position-sticky h4{font-size: 1.2rem; border-bottom: 1px solid #ddd; }

</style>
@endsection
@section('content')

<!------------------- BREADCRUMB ------------------->
<section class="sec-breadcrumb">
	<div class="container">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{asset('')}}{{asset('')}}">Trang chủ</a></li>
			<li class="breadcrumb-item"><a href="{{asset('')}}{{$articles->category->slug}}">{{$articles->category->name}}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{$articles->name}}</li>
			</ol>
		</nav>
	</div>
</section>
<!------------------- END: BREADCRUMB ------------------->


<!------------------- CARD ------------------->
<section class="card-grid news-sec">
	<div class="container">
		<div class="row">
			<div class="col-lg-9">
				<div class="label-subpage"><span>{{$articles->category->name}}</span></div>
				<div class="title-subpage">
					<div class="time-box">
						<span>{{date('d/m',strtotime($articles->created_at))}}</span>
						<span><i class="icon-time me-1"></i>{{date('Y',strtotime($articles->created_at))}}</span>
					</div>
					<h1>{{$articles->name}}</h1>
				</div>
				<div class="main-content">
					<div class="row">
						<div class="col-md-1">
							<div class="share-social affix">
								<span><small>Share</small></span>
								<ul>
									<li><a href="{{asset('')}}#"><i class="icon-facebook"></i></a></li>
									<div class="zalo-share-button" data-href="" data-oaid="3806913012913629376" data-layout="4" data-color="white" data-customize="false"></div>
								</ul>
							</div>
						</div>
						<div class="col-md-11">
							<div class="main-article" id="contents">
								<div class="description">
									{{$articles->detail}}
								</div>
								{!! $articles->content !!}
							</div>
						</div>
					</div>
					
				</div>
				<div class="tags">
					<span>tags</span>
					<ul>
						<li><a href="{{asset('')}}#">Bất động sản</a></li>
					</ul>
				</div>
			</div>
			<div class="col-lg-3 d-none d-lg-block">
				@if($articles->style == 'on')
				<div class="widget affix widget-list mb-3">
					<div class="position-sticky" style="top: 4.5rem;">
					<h4><span>Mục lục</span></h4>
					<div id="toc"  ></div>
					</div>
				</div>
				@else

				<div class="widget widget-list mb-3">
					<h4><span>Tin tức</span></h4>
					<ul>
						<li><a href="{{asset('')}}#"><i class="icon-next me-2"></i>Thị trường bất động sản</a></li>
					</ul>
				</div>

				<div class="widget widget-list widget-news mb-3">
					<h4><span>Tin tức nổi bật</span></h4>
					<a href="{{asset('')}}#" class="news-item">
						<span><img src="{{asset('')}}frontend/images/space-3.gif" style="background-image: url('https://media.ex-cdn.com/EXP/media.taichinhdoanhnghiep.net.vn/files/news/2021/03/26/ha-noi-diem-danh-nhieu-ong-trum-bat-dong-san-tri-hoan-nop-tien-dat-134146.jpg');" alt="" class="w-100"></span>
						<div class="news-item-body">
							<span class="date"><i class="icon-time me-1"></i>2 ngày trước</span>
							<p class="mb-0 text-truncate-set text-truncate-set-2">Chính chủ cần chuyển nhượng gấp căn hộ diện tích 80m2</p>
						</div>
					</a>
					
				</div>
				
				@endif

			</div>
		</div>

		
	</div>
</section>
<!------------------- END CARD ------------------->

<!------------------- RELATED ------------------->
<div class="related-sec">
	<div class="container">
		<div class="related">
			<div class="cover-title-home">
				<div class="text-start">
					<div class="cover-title">
						<h2><span class="cover-title-filled text-main">Tin tức liên quan</span></h2>
					</div>
				</div>
			</div>
			<div class="position-relative">
				<div class="swiper mySwiper">
					<div class="swiper-wrapper">
						
						<div class="swiper-slide">
							<div class="card card-s card-s4">
								<a href="{{asset('')}}#">
									<span><img src="{{asset('')}}frontend/images/space-3.gif" class="card-img-top" style="background-image: url('https://eaglereal.net/wp-content/uploads/2020/04/phoi-canh-du-an-green-square-1024x768.jpg');" alt="..."></span>
									<span class="view-more">Chi tiết</span>
								</a>
								<div class="card-body">
									<div class="card-body-wrap">
										<h5 class="card-title"><a href="{{asset('')}}#" class="text-truncate-set text-truncate-set-2">Nhà tiền chế cấp 4 nhiều phòng ngủ</a></h5>
										<div class="card-info">
											<span><i class="icon-time me-2"></i>15/02/2022</span>
										</div>
									</div>
									<div class="card-text">
										<p class="text-truncate-set text-truncate-set-2 mb-0">Vì sao giá bất động sản ven sông lại có biên độ tăng giá tốt nhất TP.HCM hiện nay?</p>
									</div>
								</div>
							</div>
						</div>
						
					</div>
					<div class="swiper-pagination"></div>
				</div>
				<div class="swiper-button-next"></div>
				<div class="swiper-button-prev"></div>
			</div>
		</div>
	</div>
</div>
<!------------------- END RELATED ------------------->

@endsection
@section('script')
<script src="{{asset('')}}frontend/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('')}}frontend/js/swiper-bundle.min.js"></script>
<script src="{{asset('')}}frontend/js/custom.js"></script>
<!-- Initialize Swiper -->
<script>
	var swiper = new Swiper(".mySwiper", {
			slidesPerView: 1,
			spaceBetween: 10,
			pagination: {
				el: ".swiper-pagination",
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
						nextEl: ".swiper-button-next",
						prevEl: ".swiper-button-prev",
					},
				}
			},	
		});
</script>

<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function () {
  TableOfContents();
});
function xu_ly_ky_tu_trang(str) {
  // Gộp nhiều dấu space thành 1 space
  str = str.replace(/\s+/g, " ");
  // loại bỏ toàn bộ dấu space (nếu có) ở 2 đầu của xâu
  return str.trim();
}
function loai_bo_ky_tu_khong_la_chu_so(str) {
  return str.replace(
    /[^0-9a-zàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ\s]/gi,
    ""
  );
}
function xoa_dau(str) {
  str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
  str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
  str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
  str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
  str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
  str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
  str = str.replace(/đ/g, "d");
  str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
  str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
  str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
  str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
  str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
  str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
  str = str.replace(/Đ/g, "D");
  return str;
}
function full_xu_ly(str) {
  str = xu_ly_ky_tu_trang(str);
  str = loai_bo_ky_tu_khong_la_chu_so(str);
  str = xoa_dau(str);
  return str;
}
function TableOfContents(container, output) {
  var toc = "";
  var level = 0;
  var container =
    document.querySelector(container) || document.querySelector("#contents");
  var output = output || "#toc";

  container.innerHTML = container.innerHTML.replace(
    /<h([\d])>([^<]+)<\/h([\d])>/gi,
    function (str, openLevel, titleText, closeLevel) {
      if (openLevel != closeLevel) {
        return str;
      }

      if (openLevel > level) {
        toc += new Array(openLevel - level + 1).join("<ul>");
      } else if (openLevel < level) {
        toc += new Array(level - openLevel + 1).join("</li></ul>");
      } else {
        toc += new Array(level + 1).join("</li>");
      }

      level = parseInt(openLevel);

      var anchor = full_xu_ly(titleText.replace(/ /g, "_"));

      toc += '<li><a class="scroll-to" href="#' + anchor + '">' + titleText + "</a>";

      return (
        "<h" +
        openLevel +
        '  id="' +
        anchor +
        '">' +
        titleText +
        "</h" +
        closeLevel +
        ">"
      );
    }
  );

  if (level) {
    toc += new Array(level + 1).join("</ul>");
  }
  //console.log(toc);
  document.querySelector(output).innerHTML += toc;
}


$(window).scroll(function() {
    var scrollDistance = $(window).scrollTop() + 20;
    $('h2,h3').each(function(i) {
        if ($(this).position().top <= scrollDistance) {
            $('#toc ul ul li a.active').removeClass('active');
            $('#toc a').eq(i).addClass('active');
        }
    });
}).scroll();
</script>
@endsection