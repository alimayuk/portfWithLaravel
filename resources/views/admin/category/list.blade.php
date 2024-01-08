@extends('layouts.admin')
@section('title')
    Admin Kategori Listesi
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/adminList.css') }}">
@endsection
@section('content')
    <section class="catList">
        <div class="container">
            <h2>Kategori Listesi</h2>
            <div class="table-wrapper">
                <table class="fl-table">
                    <thead>
                        <tr>
                            <th>Görsel</th>
                            <th>Kategori Adı</th>
                            <th>Görünürlük</th>
                            <th>SEO Kelimeleri</th>
                            <th>SEO Açıklaması</th>
                            <th>Açıklama</th>
                            <th>Oluşturma Tarihi</th>
                            <th>Ayarlar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>

                                <td><img class="listImg" src="{{isset($category->image) ? asset( $category->image) : asset( $settings->category_default_image) }}" alt=""></td>
                                <td>{{ $category->title }}</td>
                                <td>
                                    @if ($category->status)
                                        <a data-id="{{ $category->id }}" class="statusActiveBtn btnChangeStatus"
                                            href="javascript:void(0)">Aktif</a>
                                    @else
                                        <a data-id="{{ $category->id }}" class="statusPasifBtn btnChangeStatus"
                                            href="javascript:void(0)">Pasif</a>
                                    @endif

                                </td>
                                <td>{{ $category->seo_keywords }}</td>
                                <td>{{ substr($category->seo_description, 0, 25) }}...</td>
                                <td>{{ substr($category->description, 0, 25) }}...</td>
                                <td>{{ \Carbon\Carbon::parse($category->created_at)->format("d-m-Y") }}</td>
                                <td class="editColumn">
                                    <a href="{{ route('category.edit',['id' => $category->id]) }}" class="btn"><i class="far fa-edit"></i></a>
                                    <a data-id="{{ $category->id }}" href="javascript:void(0)" class="btnDelete"><i class="fas fa-trash-alt"></i></a>
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
                let categoryId = $(this).data('id');
                $('#inputStatus').val(categoryId);
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
                            "{{ route('category.changeStatus') }}");
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
                    cancelButtonText:"Çıkış"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#statusChangeForm').attr('action', "{{ route('category.delete') }}");
                        $('#statusChangeForm').submit();
                    }
                });
            });

        });
    </script>
@endsection
