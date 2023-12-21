<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/adminStyle.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/adminNavbar.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
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
                <i class="fas fa-tachometer-alt"></i>Anasayfa</a>
            </div>

            <div class="item">
                <a class="subBtn">
                    <i class="far fa-plus-square"></i>Makale<i class="fas fa-arrow-right dropdown"></i>
                </a>
                <div class="subMenu">
                    <a href="{{ route('article.index') }}" class="subItem">Makale Listesi</a>
                    <a href="{{ route('article.create') }}" class="subItem">Makale Oluştur</a>
                </div>
            </div>
            <div class="item">
                <a class="subBtn"><i class="fas fa-ellipsis-v"></i></i>Kategori <i
                        class="fas fa-arrow-right dropdown"></i></a>
                <div class="subMenu">
                    <a href="{{ route('category.index') }}" class="subItem">Kategori Listesi</a>
                    <a href="{{ route('category.create') }}" class="subItem">Kategori Oluştur</a>
                </div>
            </div>
            <div class="item">
                <a href="{{ route('settings') }}"><i class="fas fa-cog"></i>Ayarlar</a>
            </div>
            <div class="item">
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i>Çıkış Yap</a>
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
