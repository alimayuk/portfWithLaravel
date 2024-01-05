@extends('layouts.front')
@section('title')
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    <style>
        .gallery{
            padding: 100px 10px;
            background-color: #101828;
        }

        .gallery .container{
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .gallery .littleImg {
            width: 200px;
            height: 200px;
            object-fit: cover;
            transition: all ease .4s;
        }
        .gallery .littleImg:hover{
            scale: 1.05;
        }
    </style>
@endsection
@section('content')
    <div class="gallery">
        <div class="container">
            @foreach ($gallery as $item)
                <a data-caption="{{ $item->title }}" data-fancybox="gallery" data-src="{{ asset($item->image_path) }}">
                    <img class="littleImg" src="{{ asset($item->image_path) }}" />
                </a>
            @endforeach

        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script>
        Fancybox.bind('[data-fancybox="gallery"]', {
            //
        });
    </script>
@endsection
