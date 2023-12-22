@extends('layouts.admin')
@section('title')
    Admin Blog Listesi
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/adminList.css') }}">
@endsection
@section('content')
    <section class="catList">
        <div class="container">
            <h2>Blog Listesi</h2>
            <div class="table-wrapper">
                <table class="fl-table">
                    <thead>
                        <tr>
                            <th>Görsel</th>
                            <th>Başlık</th>
                            <th>Kategori</th>
                            <th>Görünürlük</th>
                            <th>Anasayfada Görünürlük</th>
                            <th>SEO Kelimeleri</th>
                            <th>SEO Açıklaması</th>
                            <th>Açıklama</th>
                            <th>Okunma Süresi</th>
                            <th>Oluşturma Tarihi</th>
                            <th>Ayarlar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($articles as $article)
                            <tr>

                                <td><img class="listImg" src="{{ asset($article->image) }}" alt=""></td>
                                <td>{{ substr($article->title, 0, 10) }}..</td>
                                <td>{{ $article->category->title }}</td>
                                <td>
                                    @if ($article->status)
                                        <a data-id="{{ $article->id }}" class="statusActiveBtn btnChangeStatus"
                                            href="javascript:void(0)">Aktif</a>
                                    @else
                                        <a data-id="{{ $article->id }}" class="statusPasifBtn btnChangeStatus"
                                            href="javascript:void(0)">Pasif</a>
                                    @endif

                                </td>
                                <td>
                                    @if ($article->feature_status)
                                        <a data-id="{{ $article->id }}" class="statusActiveBtn btnFeatureChangeStatus"
                                            href="javascript:void(0)">Aktif</a>
                                    @else
                                        <a data-id="{{ $article->id }}" class="statusPasifBtn btnFeatureChangeStatus"
                                            href="javascript:void(0)">Pasif</a>
                                    @endif

                                </td>
                                <td>{{ substr($article->seo_keywords, 0, 10) ?? "boş"}}</td>
                                <td>{{ substr($article->seo_description, 0, 10) }}...</td>
                                <td>{{ substr($article->description, 0, 25) }}...</td>
                                <td>{{ $article->read_time }}</td>
                                <td>{{ \Carbon\Carbon::parse($article->created_at)->format("d-m-Y") }}</td>
                                <td class="editColumn">
                                    <a href="{{ route('article.edit', ['id' => $article->id]) }}" class="btn"><i
                                            class="far fa-edit"></i></a>
                                    <a data-id="{{ $article->id }}" href="javascript:void(0)" class="btnDelete"><i
                                            class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <form action="" method="POST" id="statusChangeForm">
        @csrf
        <input type="hidden" name="id" id="inputStatus" value="">
    </form>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('.btnChangeStatus').click(function() {
                let articleID = $(this).data('id');
                $('#inputStatus').val(articleID);
                Swal.fire({
                    title: "Görünürlüğü Değiştirmek İstediğinize Emin misiniz ?",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Kaydat",
                    denyButtonText: `Kaydetme`,
                    cancelButtonText: "Çıkış"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $("#statusChangeForm").attr("action",
                            "{{ route('article.changeStatus') }}");
                        $('#statusChangeForm').submit();

                    } else if (result.isDenied) {
                        Swal.fire("Changes are not saved", "", "info");
                    }
                });
            });
            $('.btnFeatureChangeStatus').click(function() {
                let articleID = $(this).data('id');
                $('#inputStatus').val(articleID);
                Swal.fire({
                    title: "Görünürlüğü Değiştirmek İstediğinize Emin misiniz ?",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Kaydat",
                    denyButtonText: `Kaydetme`,
                    cancelButtonText: "Çıkış"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $("#statusChangeForm").attr("action",
                            "{{ route('article.changeFeatureStatus') }}");
                        $('#statusChangeForm').submit();

                    } else if (result.isDenied) {
                        Swal.fire("Changes are not saved", "", "info");
                    }
                });
            });
            $('.btnDelete').click(function() {
                let categoryID = $(this).data('id');
                $('#inputStatus').val(categoryID);
                Swal.fire({
                    title: "Kategoriyi Silmek İstediğine Emin misin ?",
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: "Sil",
                    cancelButtonText: "Çıkış"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#statusChangeForm').attr('action', "{{ route('article.delete') }}");
                        $('#statusChangeForm').submit();
                        Swal.fire("Başarıyla Silindi!", "", "success");
                    }
                });
            });

        });
    </script>
@endsection
