@extends('layout.index')

@section('title'){{ isset($articles->title) ? $articles->title : $articles->name }}@endsection
@section('description'){{$articles->description}}@endsection
@section('keywords'){{$articles->keywords}}@endsection
@section('robots'){{ $articles->robot == 0 ? 'index, follow' : 'noindex, nofollow' }}@endsection
@section('url'){{asset('').$articles->category->slug.'/'.$articles->slug.'.html'}}@endsection

@section('content')



@endsection