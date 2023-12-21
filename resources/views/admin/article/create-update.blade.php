@extends('layouts.admin')
@section('title')
    Admin Blog {{ isset($category) ? "Güncelle" : "Oluştur" }}
@endsection
@section("css")
<link rel="stylesheet" href="{{ asset('assets/css/adminCategoryCreate.css') }}">
@endsection

@section("content")
   <section class="catCreate">
    <div class="container">
        <h2 class="formTitle">Blog {{ isset($article) ? "Güncelle" : "Oluştur" }}</h2>
        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">{{ $error }}</div>
                            @endforeach
                        @endif
        <form action="{{ isset($article) ? route('article.edit',['id' => $article->id]) : route('article.create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="formItem">
                <label for="title">Blog Adı*</label>
                <input type="text" required id="title" name="title" value="{{ isset($article) ? $article->title : "" }}">
            </div>
            <div class="formItem">
                <label for="category_id">Kategorisi*</label>
                <select  name="category_id" id="category_id">
                    <option value="{{ null }}">Kategori Seçin</option>
                    @foreach ($categories as $item )
                        <option value="{{ $item->id }}" {{ isset($article) && $article->category_id == $item->id ? 'selected' : "" }}   >{{ $item->title }}</option>
                    @endforeach
                </select>
            </div>
           
            {{--  DESCRİPTİON SUMMERNOTE İNDİRİLCEK --}}
            <div class="formItem">
                <label for="summernote">Açıklama*</label>
                <textarea name="description" id="summernote">{!! isset($article) ? $article->description : ""  !!}</textarea>
            </div>
            <div class="formItem">
                <label for="seo_keywords">Anahtar Kelimeler</label>
                <textarea name="seo_keywords" id="seo_keywords" cols="30" rows="5">{{ isset($article) ? $article->seo_keywords : '' }}</textarea>
            </div>
            <div class="formItem">
                <label for="seo_description">Seo Açıklama</label>
                <textarea name="seo_description" id="seo_description" cols="30" rows="10">{{ isset($article) ? $article->seo_description : '' }}</textarea>
            </div>
            <div class="formItem">
                <label for="image">Resim <span class="labelLitDesc">maksimum 2mb olmalıdır</span></label>
                <input type="file" id="image" name="image" accept="image/png, image/jpeg, image/jpg">
                @if (isset($article) && $article->image)
                    <img src="{{ asset($article->image) }}" alt="" class="ListImg">
                @endif
            </div>
            <div class="formItem">
                <label for="feature_status">Anasayfada görünsün mü ?</label>
                <input class="formCheckbox" type="checkbox" value="1" id="feature_status" name="feature_status"
                    {{ isset($article) && $article->feature_status ? 'checked' : '' }}>
            </div>
            <div class="formItem">
                <label for="status">Sayfada görünsün mü ?</label>
                <input class="formCheckbox" type="checkbox" value="1" id="status" name="status"
                    {{ isset($article) && $article->status ? 'checked' : '' }}>
            </div>
            <button class="sendBtn">{{ isset($article) ? 'Kaydet' : 'Paylaş' }}</button>
        </form>
       </div>
   </section>
@endsection

@section('js')
    
@endsection