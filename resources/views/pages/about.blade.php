@extends('layout.index')

@section('title'){{ isset($articles->title) ? $articles->title : $articles->name }}@endsection
@section('description'){{$articles->description}}@endsection
@section('keywords'){{$articles->keywords}}@endsection
@section('robots'){{ $articles->robot == 0 ? 'index, follow' : 'noindex, nofollow' }}@endsection
@section('url'){{asset('').$articles->category->slug.'/'.$articles->slug.'.html'}}@endsection

@section('css')
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/swiper-bundle.min.css" rel="stylesheet">
<link href="css/fonts.css" rel="stylesheet">
<link href="css/common.css" rel="stylesheet">
<link href="css/header.css" rel="stylesheet">
<link href="css/footer.css" rel="stylesheet">
<link href="css/widget.css" rel="stylesheet">
<link href="css/card.css" rel="stylesheet">
<link href="css/article.css" rel="stylesheet">
@endsection
@section('content')


@endsection
@section('script')

@endsection