@extends('layouts.admin')
@section('title')
    Admin Anasayfa
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset("assets/css/adminHome.css") }}">
@endsection

@section('content')
    <div class="adminHome">
        <div class="container">
            <div class="adminPopularCard">
                <h3>En Çok Okunan Makaleler</h3>
                <div class="mostPopularCard">
                    <table class="tableContainer">
                        <thead>
                            <tr>
                                <th><h1>Başlık</h1></th>
                                <th><h1>Ziyaret</h1></th>
                                <th><h1>Yayın Süresi(Gün)</h1></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mostView as $item )
                            <tr>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->view_count }}</td>
                                <td>{{$item->gunFarki}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="totalView">
                <h3>Toplan Okunma Sayısı</h3>
                {{ $totalView }}
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
