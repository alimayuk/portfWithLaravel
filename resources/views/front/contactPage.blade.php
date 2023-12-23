@extends('layouts.front')
@section('title')
    İletişim
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/contactPage.css') }}">
@endsection
@section('content')
    <div class="contactPage">
        <div class="container">
            <h1>İletişim Formu</h1>
            <form class="cf">
                <div class="half left cf">
                    <input type="text" id="input-name" placeholder="Name">
                    <input type="email" id="input-email" placeholder="Email address">
                    <input type="text" id="input-subject" placeholder="Subject">
                </div>
                <div class="half right cf">
                    <textarea name="message" type="text" id="input-message" placeholder="Message"></textarea>
                </div>
                <input type="submit" value="Submit" id="input-submit">
            </form>
        </div>
    </div>
@endsection
