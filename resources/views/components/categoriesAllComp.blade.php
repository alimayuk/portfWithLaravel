<section class="categories">
    <div class="container">
     <x-headTitleLine>
         <x-slot name="headTitleLine">Kategoriler</x-slot>
     </x-headTitleLine>
     <div class="categoryCardWrapper">
        @foreach ($categories as $category )
        <a href="{{ route('front.category',['slug' => $category->slug]) }}" class="categoryCard">
            <img src="{{ isset($category->image) ? asset("$category->image") : asset("$settings->category_default_image")  }}" alt="">
            <h3 class="categoryCardTitle">{{ $category->title }}</h3>
        </a>
        @endforeach
     </div>
    </div>
 </section>