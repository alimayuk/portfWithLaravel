@extends('layouts.front')
@section('title')
    Ana Sayfa
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/homePage.css') }}">
@endsection
@section('content')
    <div class="hero">
        <div class="container">
            <h1>Master the power <br> of
                <span class="heroSoftText">Web </span>
                <span class="textt"></span><span class="dash"></span>
            </h1>
        </div>
        <div class="heroScrollMouse">
            <i class="fas fa-mouse"></i>
            <i class="fas fa-long-arrow-alt-down"></i>
        </div>
    </div>
    @if (isset($settings) && $settings->feature_cat_is_active)
       
        <section class="features">
            <div class="container">
                <x-headTitleLine>
                    <x-slot name="headTitleLine">Öne Çıkanlar</x-slot>
                </x-headTitleLine>
                
                <div class="featureCardList">
                    @foreach ($articles as $item )
                    <x-feature-comp class="featureCard aosHiddenLeft hParent">
                        <x-slot name="cardCatTitle">{!! $item->category->title !!}</x-slot>
                        <x-slot name="title">{!! $item->title !!}</x-slot>
                        <x-slot name="articleSlug">{{ $item->slug }}</x-slot>
                        <x-slot name="categorySlug">{{ $item->category->slug }}</x-slot>
                    </x-feature-comp>
                    @endforeach
                </div>
                
            </div>
        </section>
    @endif
    @include('components.categoriesAllComp')
@endsection
