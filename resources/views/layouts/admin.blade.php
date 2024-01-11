<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/adminStyle.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/adminNavbar.css') }}">
    {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('assets/summernote/summernote-lite.min.css') }}">
    @yield('css')
</head>

<body>

    <div class="menuBtn">
        <i class="fas fa-bars"></i>
    </div>
    <div class="sideBar">
        <div class="closeBtn"><i class="fas fa-times"></i></div>
        <div class="menu">
            <div class="item"><a href="{{ route("admin.index") }}">
                Anasayfa<i class="fas fa-tachometer-alt itemIcon"></i></a>
            </div>

            <div class="item">
                <a class="subBtn">
                    <i class="fas fa-arrow-right dropdown"></i>Makale<i class="far fa-plus-square itemIcon"></i>
                </a>
                <div class="subMenu">
                    <a href="{{ route('article.index') }}" class="subItem">Makale Listesi</a>
                    <a href="{{ route('article.create') }}" class="subItem">Makale Oluştur</a>
                </div>
            </div>
            <div class="item">
                <a class="subBtn"><i
                    class="fas fa-arrow-right dropdown"></i>Kategori<i class="fa-solid fa-layer-group itemIcon"></i></i></a>
                <div class="subMenu">
                    <a href="{{ route('category.index') }}" class="subItem">Kategori Listesi</a>
                    <a href="{{ route('category.create') }}" class="subItem">Kategori Oluştur</a>
                </div>
            </div>
            <div class="item">
                <a class="subBtn"><i
                    class="fas fa-arrow-right dropdown"></i>Galeri<i class="fa-solid fa-images itemIcon"></i>
                </a>
                <div class="subMenu">
                    <a href="{{ route('gallery.index') }}" class="subItem">Görsel Listesi</a>
                    <a href="{{ route('gallery.create') }}" class="subItem">Görsel Yükle</a>
                </div>
            </div>
            <div class="item">
                <a href="{{ route('settings') }}">Ayarlar<i class="fas fa-cog itemIcon"></i></a>
            </div>
            <div class="item">
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Çıkış Yap<i class="fas fa-sign-out-alt itemIcon"></i></a>
                <form action="{{ route('logout') }}" method="POST" id="logout-form">
                    @csrf
                </form>
            </div>
        </div>
    </div>

    @yield('content')


    

    <script src="{{ asset('assets/jquery/dist/jquery.min.js') }}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="{{ asset("assets/summernote/summernote-lite.min.js") }}"></script>
    <script src="{{ asset('assets/js/text-editor.js') }}"></script>
    <script>
         $(document).ready(function() {
            $.ajaxSetup({
                headers:{
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.subBtn').click(function() {
                $(this).next('.subMenu').slideToggle();
                $(this).find('.dropdown').toggleClass('rotate');
            });

            $('.menuBtn').click(function() {
                $('.sideBar').addClass('active');
                $('.menuBtn').css('display', 'none');
            });

            $('.closeBtn').click(function() {
                $('.sideBar').removeClass('active');
                $('.menuBtn').css('display', 'inline');
            });
        });
    </script>
    @include('sweetalert::alert')

    @yield('js')
</body>

</html>
