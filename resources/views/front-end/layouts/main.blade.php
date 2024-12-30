<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--
    Document Title
    =============================================
    -->
    <title>MAN 2 Kota Tasikmlaya</title>
    <!--
    Favicons
    =============================================
    -->
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

    <!--
    Stylesheets
    =============================================

    -->
    <!-- Default stylesheets-->
    <link href="/assets-front-end/lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Template specific stylesheets-->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Volkhov:400i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="/assets-front-end/lib/animate.css/animate.css" rel="stylesheet">
    <link href="/assets-front-end/lib/components-font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="/assets-front-end/lib/et-line-font/et-line-font.css" rel="stylesheet">
    <link href="/assets-front-end/lib/flexslider/flexslider.css" rel="stylesheet">
    <link href="/assets-front-end/lib/owl.carousel/dist/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="/assets-front-end/lib/owl.carousel/dist/assets/owl.theme.default.min.css" rel="stylesheet">
    <link href="/assets-front-end/lib/magnific-popup/dist/magnific-popup.css" rel="stylesheet">
    <link href="/assets-front-end/lib/simple-text-rotator/simpletextrotator.css" rel="stylesheet">
    <!-- Main stylesheet and color file-->
    <link href="/assets-front-end/css/style.css" rel="stylesheet">
    <link id="color-scheme" href="/assets-front-end/css/colors/default.css" rel="stylesheet">
    @yield('gambar_sampul')
</head>
<body data-spy="scroll" data-target=".onpage-navigation" data-offset="60" style="font-size:1.5em;">
    <main style="background-color:{{ color() }}">
        <div class="page-loader">
            <div class="loader">Loading...</div>
        </div>
        <section class="home-section bg-dark-60 portfolio-page-header parallax-bg" id="home" data-background="{{ (isset($sampul)) ? '/storage/'.$sampul : '/assets-front-end/images/about_bg.jpg' }}">
            <div class="titan-caption">
                <div class="caption-content">
                    @if ($sub_judul == 'Zona Integritas')
                    {{-- <div class="font-alt mb-30 titan-title-size-1">{{ $sub_judul }}</div> --}}
                <div class="font-alt mb-40 titan-title-size-3"><b>SELAMAT DATANG DI <br> KAWASAN ZONA INTEGRITAS <br> WILAYAH BEBAS DARI KORUPSI</b></div>
                <img src="/assets/img/2.png" alt="" width="101vh">
                <img src="/assets/img/AdminLTELogo2.jpg" width="85vw" style="border-radius:7px;margin:0 7px">
                <img src="/assets/img/3.png" alt="" width="100vh">
                <img src="/assets/img/4.png" alt="" width="100vh">
                <img src="/assets/img/5.png" alt="" width="100vh">
                @else
                <div class="font-alt mb-30 titan-title-size-1"><img src="/assets/img/AdminLTELogo.png" width="75vw"></div>
                <div class="font-alt mb-30 titan-title-size-1">{{ $sub_judul }}</div>
                <div class="font-alt mb-40 titan-title-size-4"><b>Man 2 Kota Tasikmalaya</b></div>
                <div class="font-alt titan-title-size-3">Cerdas mandiri berakhlak mulia</div>
                @endif
            </div>
            </div>
        </section>
        @include('front-end.layouts.header')
        @yield('container')
    </main>
    <section>
        <footer class="footer bg-dark">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <p class="copyright font-alt"><a href="index.html">MAN 2 KOTA TASIKMALAYA</a>, All Rights Reserved</p>
                    </div>
                    <div class="col-sm-6">
                    </div>
                </div>
            </div>
        </footer>
    </section>
    <!--
    JavaScripts
    =============================================
    -->
    <script src="/assets-front-end/lib/jquery/dist/jquery.js"></script>
    <script src="/assets-front-end/lib/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/assets-front-end/lib/wow/dist/wow.js"></script>
    <script src="/assets-front-end/lib/jquery.mb.ytplayer/dist/jquery.mb.YTPlayer.js"></script>
    <script src="/assets-front-end/lib/isotope/dist/isotope.pkgd.js"></script>
    <script src="/assets-front-end/lib/imagesloaded/imagesloaded.pkgd.js"></script>
    <script src="/assets-front-end/lib/flexslider/jquery.flexslider.js"></script>
    <script src="/assets-front-end/lib/owl.carousel/dist/owl.carousel.min.js"></script>
    <script src="/assets-front-end/lib/smoothscroll.js"></script>
    <script src="/assets-front-end/lib/magnific-popup/dist/jquery.magnific-popup.js"></script>
    <script src="/assets-front-end/lib/simple-text-rotator/jquery.simple-text-rotator.min.js"></script>
    <script src="/assets-front-end/js/plugins.js"></script>
    <script src="/assets-front-end/js/main.js"></script>
</body>
</html>
