<footer>
    
    <div class="container  
    ">
        <div class="footerTop aosHiddenBottom  ">
            <h3>En Son Güncellemeleri Alın</h3><div class="line-separator"></div>
            <p class="footerDesc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum
                tristique.</p>
            <form action="">
                <input type="email" placeholder="Email Adresi">
                <button>Abone Ol</button>
            </form>
            <p class="termtext">
                By clicking Subscribe Up you're confirming that you agree with our
                <a href="">Terms and Conditions</a>.
            </p>
        </div>
        <div class="footerMid aosHiddenLeft " >
            <div class="fm-left">
                <a href="">{!! $settings->logo !!}</a>
            </div>
           
            <div class="fm-mid">
                <ul>
                    <li><a href="">Blog</a></li>
                    <li><a href="">Kategoriler</a></li>
                    <li><a href="">Hakkımda</a></li>
                    <li><a href="">İletişim</a></li>
                </ul>
            </div>
            <div class="fm-right">
                <ul class="socials">
                    <li><a href=""><i class="fab fa-instagram"></i></a></li>
                    <li><a href=""><i class="fab fa-twitter"></i></a></li>
                    <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href=""><i class="fab fa-linkedin-in"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="footerBot aosHiddenRight hParent ">
            © {!! isset($settings) ? $settings->footerText : "Made By Web SoftWare." !!}
        </div>
    </div>
</footer>


