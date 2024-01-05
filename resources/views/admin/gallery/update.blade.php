@extends('layouts.admin')
@section('title')
    Admin Görsel {{ isset($gallery) ? 'Güncelle' : 'Ekle' }}
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/adminCategoryCreate.css') }}">
@endsection

@section('content')
    <section class="catCreate">
        <div class="container">
            <h2 class="formTitle">Görsel {{ isset($gallery) ? 'Güncelle' : 'Ekle' }}</h2>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            @endif
            <form action="{{ isset($gallery) ? route('gallery.edit', ['id' => $gallery->id]) : route('gallery.create') }}"
                id="galleryForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="formItem">
                    <label for="title">Görsel Başlığı</label>
                    <input type="text" id="title" name="title" class="@if ($errors->has('title')) red @endif"
                        name="title" id="title" value="{{ isset($gallery) ? $gallery->title : '' }}">
                </div>
                <div class="formItem">
                    <label for="image">Resim <span class="labelLitDesc">maksimum 2mb olmalıdır</span></label>
                    <input type="file" id="image" name="image" accept="image/png, image/jpeg, image/jpg">
                    @if (isset($category) && $category->image)
                        <img src="{{ asset($category->image) }}" alt="" class="ListImg">
                    @endif
                </div>
                <button class="sendBtn">{{ isset($gallery) ? 'Kaydet' : 'Paylaş' }}</button>
            </form>
        </div>
    </section>
@endsection

@section('js')
@endsection
