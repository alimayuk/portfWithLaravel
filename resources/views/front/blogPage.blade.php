@extends('layouts.front')
@section('title')
    Bloglar
@endsection
@section('css')

<style>
    .blogPage{
        background-color: #101828;
    }
    .blogPage .container{
        padding: 100px 10px 0;
    }
    .blogPage h1{
        text-align: left;
        margin-bottom: 30px;
        color: white;
        text-transform: capitalize;
    }
    .blogPage .cardsWrapper {
        display: flex;
        flex-wrap: wrap;
        align-content: center;
        justify-content: center;
        gap: 50px;
    }
    .blogPage .blogCard{
        width: 300px;
        min-height: max-content;
        word-wrap: break-word;
        display: flex;
        flex-direction: column;
        gap: 20px;
        color: white;
        border: 1px solid white
    }
    .blogPage .blogCard .cardHead{
        width: 100%;
        height: 200px;
    }
    .blogPage .blogCard img{
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
    .blogPage .blogCard .cardBody{
        display: flex;
        flex-direction: column;
        gap: 20px;
        padding: 0 10px 30px
    }
    .blogCard .cardBottom{
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        height: 100%;
        align-self: center;
        margin-bottom: 20px;
    }
    .blogCard .cardBottom a{
        border: none;
        background-color: #057EFF;
        padding: 8px 25px;
        border-radius: 5px;
        color: white;
    }
    .blogCard .readTime{
   
        color: grey
    }
    footer {
        padding: 80px 5px 10px
    }
</style>
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
