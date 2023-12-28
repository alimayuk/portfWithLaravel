@extends('layouts.front')
@section('title')
    Kategori Blog Sayfası
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/catArticleList.css') }}">
@endsection
@section('content')
    <div class="categoryPage">
        <div class="container">
            <x-headTitleLine>
                <x-slot name="headTitleLine">{{ $category->title }}</x-slot>
            </x-headTitleLine>
            <div class="cardsWrapper">
                @foreach ($articles as $item)
                    <div class="blogCard">
                        <div class="cardHead">
                            <img src="{{ isset($item->image) ? asset("$item->image") : asset("$settings->article_default_image")  }}" alt="">
                        </div>
                        <div class="cardBody">
                            <div class="cardTitle">{{ $item->title }} 
                            </div>
                            <span class="readTime">{{ $item->read_time }} dk</span>
                           
                        </div>
                        <div class="cardBottom">
                            <a href="{{ route('front.articleDetail',['categorySlug' => $category->slug, 'articleSlug' => $item->slug])}}">Okumaya Devam Et</a>
                        </div>
                    </div>
                @endforeach
                {{-- {{ $articles->links() }} --}}
            </div>
        </div>
    </div>
@endsection
