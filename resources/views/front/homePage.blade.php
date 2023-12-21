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
    <section class="features">
        <div class="container">
            <x-headTitleLine>
                <x-slot name="headTitleLine">Featured</x-slot>
            </x-headTitleLine>
           <div class="featureCardList">
            <x-feature-comp class="featureCard aosHiddenLeft hParent">
                <x-slot name="cardCatTitle">Teknddoloji</x-slot>
                <x-slot name="title">Post</x-slot>
            </x-feature-comp>
            <x-feature-comp class="featureCard aosHiddenRight">
                <x-slot name="cardCatTitle">s</x-slot>
                <x-slot name="title">Boğa Piayasasının Yükselmesi Ve Düşüler</x-slot>
            </x-feature-comp>
            <x-feature-comp class="featureCard aosHiddenLeft">
                <x-slot name="cardCatTitle">dsa</x-slot>
                <x-slot name="title">Post</x-slot>
            </x-feature-comp>
           </div>
        </div>
    </section>
    @include("components.categoriesAllComp")
    
@endsection
