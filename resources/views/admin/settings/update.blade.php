@extends('layouts.admin')
@section('title')
    Ayarlar
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/adminCategoryCreate.css') }}">
@endsection

@section('content')
    <section class="catCreate">
        <div class="container">
            <h2 class="formTitle">Ayarlar</h2>
            @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">{{ $error }}</div>
                            @endforeach
            @endif
            <form
                action="{{route('settings')}}"
                id="settingsForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="formItem">
                    <label for="logo">Logo Yazısı</label>
                    <textarea name="logo" id="logo">{!! isset($settings) ? $settings->logo : ""  !!}</textarea>
                </div>
                <div class="formItem">
                    <label for="footer_text">Footer Yazısı</label>
                    <textarea name="footerText" id="footer_text">{!! isset($settings) ? $settings->footerText : ""  !!}</textarea>
                </div>
                <div class="formItem">
                    <label for="about">Hakkımızda Yazısı</label>
                    <textarea name="aboutText" id="about">{!! isset($settings) ? $settings->aboutText : ""  !!}</textarea>
                </div>
                <div class="formItem">
                    <label for="feature_cat_is_active">Öne Çıkanlar Alanı Anasayfada görünsün mü ?</label>
                    <input class="formCheckbox" type="checkbox" value="1" id="feature_cat_is_active" name="feature_cat_is_active"
                        {{ isset($settings) && $settings->feature_cat_is_active ? 'checked' : '' }}>
                </div>
                <div class="formItem">
                    <label for="category_default_image">Kategori Varsayılan Görsel <span class="labelLitDesc">maksimum 2mb olmalıdır</span></label>
                    <input type="file" id="category_default_image" name="category_default_image" accept="image/png, image/jpeg, image/jpg">
                    @if (isset($settings) && $settings->category_default_image)
                        <img src="{{ asset($settings->category_default_image) }}" alt="" class="ListImg">
                    @endif
                </div>
                <div class="formItem">
                    <label for="article_default_image">Blog Varsayılan Görsel <span class="labelLitDesc">maksimum 2mb olmalıdır</span></label>
                    <input type="file" id="article_default_image" name="article_default_image" accept="image/png, image/jpeg, image/jpg">
                    @if (isset($settings) && $settings->article_default_image)
                        <img src="{{ asset($settings->article_default_image) }}" alt="" class="ListImg">
                    @endif
                </div>
                <button class="sendBtn">Kaydet</button>
            </form>
        </div>
    </section>
@endsection

@section('js')
@endsection
