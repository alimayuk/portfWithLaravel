@extends('layouts.front')
@section('title')
    Hakkımızda
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/aboutPage.css') }}">
@endsection
@section('content')
    <div class="aboutPage">
        <div class="container">
            <h1>Hakkımızda</h1>
            <div class="aboutTextWrapper">
                {!! isset($settings) ? $settings->aboutText : "aaaa" !!}
            </div>
        </div>
    </div>
@endsection