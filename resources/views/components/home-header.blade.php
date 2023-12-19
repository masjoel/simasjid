<header id="header" class="site-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6 col-5">
                <div class="site">
                    <div class="site__menu">
                        <a title="Menu Icon" href="#" class="site__menu__icon">
                            <i class="las la-bars la-24-black"></i>
                        </a>
                        <div class="popup-background"></div>
                        <div class="popup popup--left">
                            <a title="Close" href="#" class="popup__close">
                                <i class="las la-times la-24-black"></i>
                            </a>
                            <div class="popup__content">
                                <div class="popup__user popup__box open-form">
                                    @if (auth()->check())
                                        <a href="{{ route('dashboard') }}" title="Dashboard"><i class="fa fa-dashboard" style="font-size: 24px"></i> Dashboard</a>
                                    @else
                                        <a href="{{ route('login') }}" title="Login">Login</a>
                                    @endif
                                </div>
                                <div class="popup__menu popup__box">
                                    <ul class="menu-arrow">
                                        <li>
                                            <a href="#" title="Pendaftaran">Pendaftaran</a>
                                            <ul class="sub-menu">
                                                <li><a href="/form-team100" title="Tim 100">Tim 100</a></li>
                                                <li><a href="/form-luarnegeri" title="Luar Negeri">Luar Negeri</a></li>
                                                <li><a href="/form-dante" title="Komandan Teritori">Komandan
                                                        Teritori</a></li>
                                                <li><a href="/form-pejuang" title="Pejuang Saksi">Pejuang Saksi</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="/kode-wilayah" title="Kode Wilayah">Kode Wilayah</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="site__brand">
                        <a title="Logo" href="{{ route('home') }}" class="site__brand__logo"><img
                                src="{{ klien('logo') == null ? asset('image/logo-bakorsi.jpeg') : Storage::url(klien('logo')) }}" style="height:80px; width:auto" alt="{{ klien('nama_client') }}"></a>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-7">
                <div class="right-header align-right">
                    <nav class="main-menu">
                        <ul>
                            <li>
                                <a href="#" title="Pendaftaran">Pendaftaran</a>
                                <ul class="sub-menu">
                                    <li><a href="/form-team100" title="Tim 100">Tim 100</a></li>
                                    <li><a href="/form-luarnegeri" title="Luar Negeri">Luar Negeri</a></li>
                                    <li><a href="/form-dante" title="Komandan Teritori">Komandan Teritori</a></li>
                                    <li><a href="/form-pejuang" title="Pejuang Saksi">Pejuang Saksi</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="/kode-wilayah" title="Kode Wilayah">Kode Wilayah</a>
                            </li>
                            <li>
                                @if (auth()->check())
                                    <a href="{{ route('dashboard') }}" title="Dashboard"><i class="fa fa-dashboard" style="font-size: 24px"></i></a>
                                @else
                                    <a href="{{ route('login') }}" title="Login">Login</a>
                                @endif
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
