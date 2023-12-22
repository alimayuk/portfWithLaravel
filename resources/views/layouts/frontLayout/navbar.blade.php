<nav class="navbar">
    <div class="content">
        <div class="logo">
            <a href="#">{!! isset($settings) ? $settings->logo : "Web SoftWare" !!}</a>
        </div>
        <ul class="menu-list">
            <div class="icon cancel-btn">
                <i class="fas fa-times"></i>
            </div>
            <li><a href="{{ route('home') }}">Anasayfa</a></li>
            <li><a href="#">Blog</a></li>
            <li><a href="{{ route('page.category') }}">Kategoriler</a></li>
            <li><a href="#">Hakkımda</a></li>
            <li><a href="#">İletişim</a></li>
        </ul>
        <a href="#" class="subscribe">
            Abone Ol
        </a>
        <div class="icon menu-btn">
            <i class="fas fa-bars"></i>
        </div>
    </div>
</nav>

