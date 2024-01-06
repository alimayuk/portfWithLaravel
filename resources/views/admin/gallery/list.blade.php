@extends('layouts.admin')
@section('title')
    Admin Galeri
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

    <style>
        .gallery {
            padding: 50px 10px;
            max-width: 1280px;
            margin: 0 auto;
        }

        .gallery .container {
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

        .gallery .littleImg:hover {
            scale: 1.05;
            cursor: pointer;
        }

        .custom-f-btn svg path {
            fill: red;
        }

        .adminImgCard {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .galleryButtons {
            display: flex;
            justify-content: center;
            gap: 5px;
            width: 100%;
        }

        .galleryButtons a {
            flex: 1;
            text-align: center;
        }

        .adminImgCard .btnDelete {
            color: white;
            font-weight: bold;
            border: none;
            background-color: red;
        }

        .adminImgCard .btnUpdate {
            background-color: orange;
            border: none;
            color: white;
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    <section class="gallery">
        <h2 class="formTitle">Görsel Listesi</h2>
        <div class="container">
            @foreach ($gallery as $item)
                <div class="adminImgCard">
                    <a data-caption="{{ $item->title }}" data-fancybox="gallery" data-src="{{ asset($item->image_path) }}">
                        <img class="littleImg" src="{{ asset($item->image_path) }}" />
                    </a>
                    <div class="galleryButtons">
                        <a href="{{ route('gallery.edit', ['id' => $item->id]) }}" class="btnUpdate">Güncelle</a>
                        <a id="REALDELETE" data-id="{{ $item->id }}" href="javascript:void(0)" class="btnDelete">Sil</a>
                    </div>
                </div>
            @endforeach

        </div>
    </section>
    <form action="" method="POST" id="statusChangeForm">
        @csrf
        <input type="hidden" name="id" id="inputStatus" value="">
    </form>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script>
        Fancybox.bind('[data-fancybox="gallery"]', {
            Toolbar: {
                items: {
                    // facebook: {
                    //     tpl: '<button id="ilkBtn" class="f-button custom-f-btn "><svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" viewBox="0 0 448 512"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg></button>',
                    //     click: () => {
                    //         $(document).ready(function() {
                    //             $('#ilkBtn').on('click', function() {
                    //                 $('#REALDELETE').trigger('click');
                    //             });
                    //         });
                    //     },
                    // },

                },
                display: {
                    left: ["infobar"],
                    middle: [],
                    //"facebook",
                    right: ["iterateZoom", "slideshow", "fullscreen", "thumbs", "close"],
                },
            },
        });
    </script>
    <script>
        $('.btnDelete').click(function(e) {
            let galleryID = $(this).data('id');
            console.log(galleryID);
            $('#inputStatus').val(galleryID);
            Swal.fire({
                title: "Görseli Silmek İstediğine Emin misin ?",
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: "Sil",
                cancelButtonText: "Çıkış"
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#statusChangeForm').attr('action',
                        "{{ route('gallery.delete') }}");
                    $('#statusChangeForm').submit();
                }
            });
        });
    </script>
@endsection
