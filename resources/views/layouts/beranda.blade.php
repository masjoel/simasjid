<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>@yield('title') &mdash; Vote</title>
    {{-- <link rel="shortcut icon" href="{{ asset('image/logo-bakorsi.jpeg') }}"> --}}
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('library/sweetalert2/sweetalert2.min.css') }}">

    @stack('style')
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">

    <style>
        @media print {
            .no-print {
                display: none;
            }
        }

        .row>* {
            flex-shrink: 0;
            width: 100%;
            max-width: 100%;
            margin-top: var(--bs-gutter-y);
        }

        .navbar-collapse {
            flex-grow: 0 !important;
        }

        @media (max-width: 991.98px) {

            .navbar-expand-lg>.container,
            .navbar-expand-lg>.container-fluid,
            .navbar-expand-lg>.container-lg,
            .navbar-expand-lg>.container-md,
            .navbar-expand-lg>.container-sm,
            .navbar-expand-lg>.container-xl {
                margin-left: 20px !important;
            }
        }
    </style>
</head>

<body>
    <div class="container content">
        <div class="row no-print">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <a href="https://votebox.id" class="navbar-brand" style="margin-left: -20px">
                        <h4 class="text-dark">{{ $profil_usaha->nama_client }}</h4>
                    </a>
                    {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="/formulir-team100">Team 100</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/formulir-pejuang">Pejuang Saksi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/formulir-dante">Dante</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/formulir-luarnegeri">Luar Negeri</a>
                            </li>
                            <li class="nav-item">
                                @if (auth()->check())
                                    <i id="{{ auth()->check() ? 'login-dashboard' : 'login-user' }}"
                                        class="{{ auth()->check() ? 'fa fa-dashboard' : '' }}"
                                        style="font-size: 25px; margin-top: 6px"></i>
                                @else
                                    <a href="#" id="login-user" class="nav-link text-dark">Login</a>
                                @endif
                            </li>
                        </ul>
                    </div> --}}
                </div>
            </nav>
        </div>
        @yield('main')
    </div>
    <div class="mt-3">&nbsp;</div>
    <div class="footer text-center no-print">
        <span class="small">Copyright {{ '@' . date('Y') }}</span>
    </div>
    @php
        $clientIP = Request::ip();
        $clientDo = request()->segments();
        $doing = $clientDo ? $clientDo[0] : Request::route()->getName();
        $log = [
            'iduser' => 0,
            'nama' => 'guest',
            'level' => '',
            'datetime' => date('Y-m-d H:i:s'),
            'do' => $doing,
            'ipaddr' => $clientIP,
        ];
        DB::table('userlog')->insert($log);
    @endphp
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    {{-- <script src="{{ asset('js/bootstrap.min.js') }}"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    @stack('scripts')
    <script src="{{ asset('library/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>

    <script>
        $(document).on('click', '#login-user', function(e) {
            e.preventDefault();
            window.location.replace("{{ route('login') }}");
        });
        $(document).on('click', '#login-dashboard', function(e) {
            e.preventDefault();
            window.location.replace("{{ route('dashboard') }}");
        });
        $(document).on("click", "a#cek-nik", function(e) {
            e.preventDefault()
            let nik = $("#nik").val();
            if (!nik) {
                let msg = 'NIK harus diisi';
                Swal.fire({
                    title: "Perhatian",
                    html: msg,
                    showConfirmButton: true,
                    confirmButtonColor: '#ff9909',
                    icon: "warning"
                });
                return;
            }
            fetch('/api/cek-nik/' + nik)
                .then(response => response.json())
                .then(data => {
                    if (data.length == 0) {
                        let msg = 'NIK belum terdaftar';
                        Swal.fire({
                            title: "Info",
                            html: msg,
                            showConfirmButton: true,
                            confirmButtonColor: '#0999ff',
                            icon: "success"
                        });
                    }
                    data.forEach(item => {
                        let msg = 'NIK ' + item.nik + ' telah digunakan<br>' + item.nama;
                        Swal.fire({
                            title: "Perhatian",
                            html: msg,
                            showConfirmButton: true,
                            confirmButtonColor: '#ff9909',
                            icon: "warning"
                        });
                        $("#nik").val('');
                    });
                })
                .catch(error => console.error('Error:', error));
        })
    </script>
</body>

</html>
