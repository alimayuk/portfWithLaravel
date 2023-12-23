@extends('layouts.front')
@section('title')
    Hakkımızda
@endsection
@section('css')
    <style>
        .aboutPage{
            background-color: #101828;
        }
        .aboutPage .container{
            padding: 100px 10px 10px;
            color:white;
        }
        .aboutPage .container h1{
            text-align: center;
        }
    </style>
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