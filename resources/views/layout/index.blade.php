<!DOCTYPE HTML>
<html lang="vi-VN">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
<!-- <base href="{{asset('')}}"> -->
<!-- seo -->
<title>@yield('title')</title>
<meta name="description" content="@yield('description')"/>
<meta name="keywords" itemprop="keywords" content="@yield('keywords')" />
<meta name="news_keywords" content="@yield('keywords')" />
<meta name="robots" content="@yield('robots')"/>
<link rel="shortcut icon" href="data/themes/{{$head_setting->img}}" />
<link rel="canonical" href="@yield('url')"/>
<link rel="alternate" href="{{asset('')}}" hreflang="vi-vn" />
<!-- and seo -->
<!-- og -->
<meta property="og:locale" content="vi_VN" />
<meta property="og:type" content="website" />
<meta property="og:title" content="@yield('title')" />
<meta property="og:description" content="@yield('description')" />
<meta property="og:url" content="@yield('url')" />
<meta property="og:site_name" content="site_name" />
<meta property="og:images" content="@yield('images')" />
<meta property="og:image" content="@yield('images')" />
<meta property="og:image:alt" content="@yield('title')" />
<!-- and og -->
<!-- twitter -->
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="@yield('title')" />
<meta name="twitter:description" content="@yield('description')" />
<!-- and twitter -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,user-scalable=0"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta property="article:author" content="admin" />
<!-- ================= Style ================== --> 

@yield('css')
<link href="frontend/css/home.css" rel="stylesheet">

<!-- google dịch -->
<style type="text/css">
  body{
    top:0 !important;
}
.goog-te-banner-frame {
    display: none;
    height: 0 !important;
    visibility: hidden
}
</style>
<!-- google dịch -->
<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script type="text/javascript">
function googleTranslateElementInit() {
new google.translate.TranslateElement({ includedLanguages: 'vi,en,ko', layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL }, 'google_translate_element');
}

function triggerHtmlEvent(element, eventName) {
var event;
if (document.createEvent) {
event = document.createEvent('HTMLEvents');
event.initEvent(eventName, true, true);
element.dispatchEvent(event);
} else {
event = document.createEventObject();
event.eventType = eventName;
element.fireEvent('on' + event.eventType, event);
}
}
$(document).ready(function () {
$(document).on('click', '.languageOption', function () {
var value = $(this).attr("data-lang");

updateLanguage(value);

})


function updateLanguage(value) {
var selectIndex = 0;
var a = document.querySelector("#google_translate_element select");
switch (value) {
case "vi":
selectIndex = 0;
break;
case "en":
selectIndex = 3;
break;
case "ko":
selectIndex = 1;
break;
}
a.selectedIndex = selectIndex;
a.dispatchEvent(new Event('change'));
}
})
</script>
<!-- google dịch -->
<!-- google dịch -->

<!-- ================= js ================== --> 

{!! $head_setting->codeheader !!}

</head>
@include('layout.function')
<body> 
@include('layout.header')

@yield('content')

@include('layout.footer')
<!------------------- JS core------------------->
@yield('script')

{!! $head_setting->codebody !!}



</body>
</html>