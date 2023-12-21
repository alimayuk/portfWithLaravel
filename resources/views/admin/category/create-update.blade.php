@extends('layouts.admin')
@section('title')
    Admin Blog {{ isset($category) ? 'Güncelle' : 'Oluştur' }}
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/adminCategoryCreate.css') }}">
@endsection

@section('content')
    <section class="catCreate">
        <div class="container">
            <h2 class="formTitle">Kategori {{ isset($category) ? 'Güncelle' : 'Oluştur' }}</h2>
            @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">{{ $error }}</div>
                            @endforeach
                        @endif
            <form
                action="{{ isset($category) ? route('category.edit', ['id' => $category->id]) : route('category.create') }}"
                id="categoryForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="formItem">
                    <label for="title">Kategori Adı</label>
                    <input type="text" id="title" name="title" class="@if ($errors->has('title')) red @endif"
                        name="title" id="title" value="{{ isset($category) ? $category->title : '' }}">
                </div>
                <div class="formItem">
                    <label for="description">Açıklama</label>
                    <textarea name="description" id="description" cols="30" rows="10"
                        class="@if ($errors->has('description')) red @endif">{{ isset($category) ? $category->description : '' }}</textarea>
                </div>
                <div class="formItem">
                    <label for="status">Sayfada görünsün mü ?</label>
                    <input class="formCheckbox" type="checkbox" value="1" id="status" name="status"
                        {{ isset($category) && $category->status ? 'checked' : '' }}>
                </div>
                <div class="formItem">
                    <label for="seo_keywords">Anahtar Kelimeler</label>
                    <textarea name="seo_keywords" id="seo_keywords" cols="30" rows="5">{{ isset($category) ? $category->seo_keywords : '' }}</textarea>
                </div>
                <div class="formItem">
                    <label for="seo_description">Seo Açıklama</label>
                    <textarea name="seo_description" id="seo_description" cols="30" rows="10">{{ isset($category) ? $category->seo_description : '' }}</textarea>
                </div>
                <div class="formItem">
                    <label for="image">Resim <span class="labelLitDesc">maksimum 2mb olmalıdır</span></label>
                    <input type="file" id="image" name="image" accept="image/png, image/jpeg, image/jpg">
                    @if (isset($category) && $category->image)
                        <img src="{{ asset($category->image) }}" alt="" class="ListImg">
                    @endif
                </div>
                <button class="sendBtn">{{ isset($category) ? 'Kaydet' : 'Paylaş' }}</button>
            </form>
        </div>
    </section>
@endsection

@section('js')
@endsection
