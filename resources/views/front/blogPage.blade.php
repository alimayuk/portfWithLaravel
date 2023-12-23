@extends('layouts.front')
@section('title')
    Bloglar
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/blogPage.css') }}">
@endsection
@section('content')
    <div class="blogPage">
        <div class="container">
           <div class="cardsWrapper">
            @foreach ($articles as $item)
                <div class="blogCard">
                    <div class="cardHead">
                        <img src="{{ asset($item->image) }}" alt="">
                    </div>
                    <div class="cardBody">
                        <div class="cardTitle">{{ $item->title }} 
                        </div>
                        <span class="readTime">{{ $item->read_time }} dk</span>
                       
                    </div>
                    <div class="cardBottom">
                        <a href="{{ route('front.articleDetail',['categorySlug' => $item->category->slug, 'articleSlug' => $item->slug])}}">Okumaya Devam Et</a>
                    </div>
                </div>
            @endforeach
            
        </div>
        </div>
    </div>
@endsection
