@extends('layouts.front')
@section('title')
    {{ $articles->title }} Blog Yazısı
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/blogDetail.css') }}">
@endsection
@section('content')
   <div class="blogDetail">
    <div class="container">
        <div class="imagewrapper">
            <img class="blogImage" src={{ asset($articles->image) }} alt="">
        </div>
        <div class="timeAndCat">
            <p>{{ $articles->category->title }}</p>
            <p>{{ $articles->read_time }} <i class="far fa-clock"></i> </p>
            
        </div>
        <h1>{{ $articles->title }}</h1>
        <div class="detailDesc">{!! $articles->description !!}</div>
    </div>
   </div>
@endsection
