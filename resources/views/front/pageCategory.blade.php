@extends('layouts.front')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/homePage.css') }}">
<style>
    .categoryPage .container{
        padding: 100px 10px 0px
    }
</style>
@endsection
@section('title')
    Kategoriler
@endsection
@section('content')
    <div class="categoryPage">
        @include('components.categoriesAllComp')
    </div>
@endsection