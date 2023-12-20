@extends('layouts.app')

@section('title', 'General Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ number_format($totalMembers->total_saksi) }} penduduk</h1>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-building"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Provinsi</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalMembers->total_provinsi }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="far fa-building"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Kabupaten/Kota</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalMembers->total_kabupaten }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-building"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Kecamatan</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalMembers->total_kecamatan }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-home"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Kelurahan</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalMembers->total_kelurahan }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Statistics</h4>
                            <div class="card-header-action">
                                <form method="GET">
                                    @csrf
                                    <div class="d-flex justify-content-right">
                                        <div class="d-flex w-100">
                                            @php
                                                $months = [
                                                    '01' => 'Januari',
                                                    '02' => 'Februari',
                                                    '03' => 'Maret',
                                                    '04' => 'April',
                                                    '05' => 'Mei',
                                                    '06' => 'Juni',
                                                    '07' => 'Juli',
                                                    '08' => 'Agustus',
                                                    '09' => 'September',
                                                    '10' => 'Oktober',
                                                    '11' => 'November',
                                                    '12' => 'Desember',
                                                ];
                                            @endphp
                                            <select name="search" class="form-control form-control-sm"
                                                style="border-radius:2px; width: 20ch !important">
                                                @foreach ($months as $m => $value)
                                                    <option value="{{ $m }}"
                                                        {{ $m == $search ? 'selected' : '' }}>
                                                        {{ $value }}</option>
                                                @endforeach
                                            </select>
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <button class="btn btn-sm btn-primary ml-2"
                                                        style="padding: 0.3rem 0.8rem; border-radius:3px !important"><i
                                                            class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart" height="182"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Penduduk baru</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled list-unstyled-border">
                                @foreach ($new_member as $item)
                                    <li class="media">
                                        <img class="rounded-circle mr-3" width="50"
                                            src="{{ $item->avatar == null ? asset('img/avatar/avatar-1.png') : Storage::url($item->avatar) }}"
                                            alt="avatar">
                                        <div class="media-body">
                                            <div class="text-primary float-right">{{ $item->created_at->diffForHumans() }}
                                            </div>
                                            <div class="media-title">{{ $item->nama }}</div>
                                            <span
                                                class="text-small text-muted">{{ $item->provinsi_id == null ? '' : $item->provinsi->name }}{{ $item->kabupaten_id == null ? '' : ', ' . $item->kabupaten->type . ' ' . $item->kabupaten->name }}{{ $item->kecamatan_id == null ? '' : ', ' . $item->kecamatan->name }}{{ $item->kelurahan_id == null ? '' : ', ' . $item->kelurahan->name }}</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="pt-1 pb-1 text-center">
                                <a href="{{ route('penduduk.index') }}" class="btn btn-primary btn-lg btn-round">
                                    View All
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Provinsi</h4>
                            <div class="card-header-action w-100">
                                <form method="GET">
                                    <div class="d-flex">
                                        @csrf
                                        <select name="search_prov" class="form-control form-control-sm select2"
                                            style="border-radius:2px">
                                            <option value="">-</option>
                                            @foreach ($data_provinsi as $value)
                                                <option value="{{ $value->id }}"
                                                    {{ $value->id == $searchProv ? 'selected' : '' }}>
                                                    {{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <button class="btn btn-sm btn-primary ml-2"
                                                    style="padding: 0.3rem 0.8rem; border-radius:3px !important"><i
                                                        class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="mb-2 overflow-x-scroll">
                                <table class="table-striped mb-0 table">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th class="text-right">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($provinsi as $item)
                                            <tr>
                                                <td>{{ $item->name }}</td>
                                                <td class="text-right text-primary">
                                                    <b>{{ number_format($item->jumlah) }}</b>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="float-right">
                                <nav>
                                    <ul class="pagination pagination-sm">
                                        @if ($searchProv == '' && $searchKab == '')
                                            {{ $provinsi->withQueryString()->links('pagination::bootstrap-4') }}
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Kabupaten/Kota</h4>
                            <div class="card-header-action w-100">
                                <form method="GET">
                                    <div class="d-flex">
                                        @csrf
                                        <select name="search_kab" class="form-control form-control-sm select2"
                                            style="border-radius:2px; width:100px !important">
                                            <option value="">-</option>
                                            @foreach ($data_kabupaten as $value)
                                                <option value="{{ $value->id }}"
                                                    {{ $value->id == $searchKab ? 'selected' : '' }}>
                                                    {{ $value->type . ' ' . $value->name }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="search_prov" value="{{ $searchProv }}">
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <button class="btn btn-sm btn-primary ml-2"
                                                    style="padding: 0.3rem 0.8rem; border-radius:3px !important"><i
                                                        class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="mb-2 overflow-x-scroll">
                                <table class="table-striped mb-0 table">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th class="text-right">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kabupaten as $item)
                                            <tr>
                                                <td>{{ $item->type . ' ' . $item->name }}</td>
                                                <td class="text-right text-primary">
                                                    <b>{{ number_format($item->jumlah) }}</b>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="float-right">
                                <nav>
                                    <ul class="pagination pagination-sm">
                                        @if ($searchProv == '' && $searchKab == '' && $searchKec == '')
                                            {{ '' }}
                                        @elseif ($searchProv !== '' && $searchKab == '' && $searchKec == '')
                                            {{ $kabupaten->withQueryString()->links('pagination::bootstrap-4') }}
                                        @else
                                            {{ '' }}
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Kecamatan</h4>
                            <div class="card-header-action w-100">
                                <form method="GET">
                                    <div class="d-flex">
                                        @csrf
                                        <select name="search_kec" class="form-control form-control-sm select2"
                                            style="border-radius:2px">
                                            <option value="">-</option>
                                            @foreach ($data_kecamatan as $value)
                                                <option value="{{ $value->id }}"
                                                    {{ $value->id == $searchKec ? 'selected' : '' }}>
                                                    {{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="search_prov" value="{{ $searchProv }}">
                                        <input type="hidden" name="search_kab" value="{{ $searchKab }}">
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <button class="btn btn-sm btn-primary ml-2"
                                                    style="padding: 0.3rem 0.8rem; border-radius:3px !important"><i
                                                        class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="mb-2 overflow-x-scroll">
                                <table class="table-striped mb-0 table">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th class="text-right">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kecamatan as $item)
                                            <tr>
                                                <td>{{ $item->name }}</td>
                                                <td class="text-right text-primary">
                                                    <b>{{ number_format($item->jumlah) }}</b>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="float-right">
                                <nav>
                                    <ul class="pagination pagination-sm">
                                        @if ($searchProv == '' && $searchKab == '' && $searchKec == '')
                                            {{ '' }}
                                        @elseif ($searchProv !== '' && $searchKab == '' && $searchKec == '')
                                            {{ '' }}
                                        @elseif ($searchProv !== '' && $searchKab !== '' && $searchKec == '' && $searchKel == '')
                                            {{ $kecamatan->withQueryString()->links('pagination::bootstrap-4') }}
                                        @else
                                            {{ '' }}
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Kelurahan</h4>
                            <div class="card-header-action w-100">
                                <form method="GET">
                                    <div class="d-flex">
                                        @csrf
                                        <select name="search_kel" class="form-control form-control-sm select2"
                                            style="border-radius:2px; width:100px !important">
                                            <option value="">-</option>
                                            @foreach ($data_kelurahan as $value)
                                                <option value="{{ $value->id }}"
                                                    {{ $value->id == $searchKel ? 'selected' : '' }}>
                                                    {{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="search_prov" value="{{ $searchProv }}">
                                        <input type="hidden" name="search_kab" value="{{ $searchKab }}">
                                        <input type="hidden" name="search_kec" value="{{ $searchKec }}">
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <button class="btn btn-sm btn-primary ml-2"
                                                    style="padding: 0.3rem 0.8rem; border-radius:3px !important"><i
                                                        class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="mb-2 overflow-x-scroll">
                                <table class="table-striped mb-0 table">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th class="text-right">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kelurahan as $item)
                                            <tr>
                                                <td>{{ $item->name }}</td>
                                                <td class="text-right text-primary">
                                                    <b>{{ number_format($item->jumlah) }}</b>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="float-right">
                                <nav>
                                    <ul class="pagination pagination-sm">
                                        @if ($searchProv == '' && $searchKab == '' && $searchKec == '' && $searchKel == '')
                                            {{ '' }}
                                        @elseif ($searchProv !== '' && $searchKab == '' && $searchKec == '' && $searchKel == '')
                                            {{ '' }}
                                        @elseif ($searchProv !== '' && $searchKab !== '' && $searchKec == '' && $searchKel == '')
                                            {{ '' }}
                                        @else
                                            {{ $kelurahan->withQueryString()->links('pagination::bootstrap-4') }}
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>

    <script type="text/javascript">
        var tgl = @json($tgl);
        var qty = @json($qty);
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: tgl,
                datasets: [{
                    label: 'Jumlah',
                    data: qty,
                    borderWidth: 2,
                    backgroundColor: 'transparent',
                    borderColor: '#6777ef',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#ffffff',
                    pointRadius: 4
                }, ],
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            drawBorder: false,
                            color: '#f2f2f2',
                        },
                    }],
                    xAxes: [{
                        ticks: {
                            display: false
                        },
                        gridLines: {
                            display: false
                        }
                    }]
                },
            }
        });
    </script>
@endpush
