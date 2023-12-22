<div {{ $attributes }}>
    <div  class="featureCardImage"></div>
    <div class="cardCatTitle">{{ $cardCatTitle }}</div>
    <a href="{{route('front.articleDetail',['categorySlug' =>$categorySlug,'articleSlug'=> $articleSlug])}}" class="featureMore">Daha Fazla <i class="fas fa-location-arrow" style="color: #007bff;"></i></a>
    <div class="featureCardName"> {{ $title }}</div>
</div>