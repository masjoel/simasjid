<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>@yield('title') &mdash; si Masjid</title>
    <meta name="robots" content="index, follow" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <!-- favicons -->
    <link rel="shortcut icon" href="{{ asset('image/simasjid-logo.jpg') }}">

    <!-- Style CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/jost/stylesheet.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/line-awesome/css/line-awesome.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/fontawesome-pro/css/fontawesome.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/slick/slick-theme.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/slick/slick.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/quilljs/css/quill.bubble.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/quilljs/css/quill.core.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/quilljs/css/quill.snow.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/chosen/chosen.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/datetimepicker/jquery.datetimepicker.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/venobox/venobox.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style-golo.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .page-title--small {
            height: 160px !important;
            background-color: goldenrod !important;
            /* background-color: #be8718 !important; */
        }
    </style>
    <!-- jQuery -->
    <script src="{{ asset('js/jquery-1.12.4.js') }}"></script>
    <script src="{{ asset('libs/popper/popper.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('libs/slick/slick.min.js') }}"></script>
    <script src="{{ asset('libs/slick/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('libs/isotope/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('libs/quilljs/js/quill.core.js') }}"></script>
    <script src="{{ asset('libs/quilljs/js/quill.js') }}"></script>
    <script src="{{ asset('libs/chosen/chosen.jquery.min.js') }}"></script>
    <script src="{{ asset('libs/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>
    <script src="{{ asset('libs/venobox/venobox.min.js') }}"></script>
    <script src="{{ asset('libs/waypoints/jquery.waypoints.min.js') }}"></script>
    <!-- orther script -->
    <script src="{{ asset('js/main.js') }}"></script>
</head>

<body>
    <div id="wrapper">
        @include('components.home-header')
        <main id="main" class="site-main">
            <div class="page-title page-title--small page-title--blog align-left"
                style="background-image: url(https://source.unsplash.com/600x150?mosque);">
                <div class="container">
                    <div class="page-title__content">
                        <h1 class="page-title__name">{{ klien('nama_app') }}</h1>
                        <p class="page-title__slogan">{{ klien('desc_app') }}</p>
                    </div>
                </div>
            </div>
            <div class="page-content isotope">
                @yield('main')
            </div>
        </main>

        <footer id="footer" class="footer mt-5">
            <div class="container">
                {{-- <div class="footer__top">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="footer__top__info">
                                <a title="Logo" href="{{ route('home') }}" class="footer__top__info__logo"><img
                                        src="{{ asset('image/logo-bakorsi.jpeg') }}" alt="Logo"></a>
                                <p class="footer__top__info__desc">{{ klien('desc_app') }}</p>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <aside class="footer__top__nav">
                            </aside>
                        </div>
                        <div class="col-lg-2">
                            <aside class="footer__top__nav">
                            </aside>
                        </div>
                        <div class="col-lg-3">
                        </div>
                    </div>
                </div> --}}
                <div class="footer__bottom">
                    <p class="footer__bottom__copyright">Copyright {{ '@' . date('Y') }}</p>
                </div>
            </div>
        </footer>

    </div>
</body>

</html>
