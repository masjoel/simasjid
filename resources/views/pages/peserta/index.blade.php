@extends('layouts.app')

@section('title', $title)

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <style>
        .pagination {
            display: -ms-flexbox;
            flex-wrap: wrap;
            display: flex;
            padding-left: 0;
            list-style: none;
            border-radius: 0.25rem;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ $title }}</h1>
                @include('pages.peserta.breadcrumb')

            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-block text-right">
                                <div class="section-header-button">
                                    {{-- @if (Auth::user()->roles == 'deputi' || Auth::user()->username == 'masmin') --}}
                                    <a href="#" class="btn btn-sm btn-danger ml-2" id="export-data"><i
                                            class="fa fa-download"></i> Export</a>
                                    <a href="#" class="btn btn-sm btn-danger ml-2" id="export-data-tanpa-nik"><i
                                            class="fa fa-download"></i> Export tanpa NIK</a>
                                    {{-- @endif --}}
                                    <a href="#" class="btn btn-sm btn-dark ml-2" id="filter-data"><i
                                            class="fa fa-filter"></i> Filter</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="float-right">
                                    <form method="GET">
                                        <div class="input-group">
                                            <input type="text" name='search' class="form-control" placeholder="Search">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="clearfix mb-3"></div>
                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">NIK</th>
                                            <th scope="col">No HP</th>
                                            <th scope="col">Alamat</th>
                                            <th scope="col">Provinsi</th>
                                            <th scope="col">Kabupaten/Kota</th>
                                            <th scope="col">Kecamatan</th>
                                            <th scope="col">Kelurahan</th>
                                            @if (Auth::user()->roles == 'deputi' || Auth::user()->username == 'masmin')
                                                <th class="text-center" scope="col" width="120">Action</th>
                                            @endif
                                        </tr>
                                        @php $i=$nomor; @endphp
                                        @foreach ($pesertas as $index => $item)
                                            <tr>
                                                <td width="50">{{ $index + $pesertas->firstItem() }}</td>
                                                <td nowrap>{{ $item->nama }}</td>
                                                <td>{{ $item->nik }}</td>
                                                <td>{{ $item->telpon }}</td>
                                                <td class="text-nowrap">{{ $item->alamat }}<br>RT {{ $item->rt }} RW
                                                    {{ $item->rw }}</td>
                                                <td>
                                                    {{ $item->provinsi == null ? '' : $item->provinsi }}
                                                </td>
                                                <td>
                                                    {{ $item->kabupaten == null ? '' : $item->tipe_kab . ' ' . $item->kabupaten }}
                                                </td>
                                                <td>
                                                    {{ $item->kecamatan == null ? '' : $item->kecamatan }}
                                                </td>
                                                <td>
                                                    {{ $item->kelurahan == null ? '' : $item->kelurahan }}
                                                </td>
                                                @if (Auth::user()->roles == 'deputi' || Auth::user()->username == 'masmin')
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            <a href="{{ route('peserta.edit', $item->id) }}"
                                                                class="btn btn-sm btn-info text-nowrap" id="edit-data"
                                                                title="Edit"><i class="fa fa-edit"></i> Edit</a>
                                                            <a href="#" class="ml-2 btn btn-sm btn-danger"
                                                                id="delete-data" data-id="{{ $item->id }}"
                                                                title="Hapus" data-toggle="tooltip"><i
                                                                    class="fa fa-trash-alt"></i></a>
                                                        </div>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="float-right mt-3">
                                    <nav>
                                        <ul class="pagination pagination-sm">
                                            {{ $pesertas->withQueryString()->links('pagination::bootstrap-4') }}
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal -->
    <div class="modal fade modal-utama" id="add-modal" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="main-form" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <input type="file" class="form-control" id="input-file" name="file">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Filter --}}
    <div class="modal fade modal-utama" id="filter-modal" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="filter-form">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Provinsi</label>
                                    <select name="provinsi" class="form-control select2" id="provinsi">
                                        <option value="">- pilih Provinsi -</option>
                                        @foreach ($provinsi as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kabupaten/Kota</label>
                                    <select class="form-control select2" name="kabupaten" id="kabupaten">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kecamatan</label>
                                    <select class="form-control select2" name="kecamatan" id="kecamatan">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kelurahan</label>
                                    <select class="form-control select2" name="kelurahan" id="kelurahan">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <input type="text" name='search' class="form-control" value=""
                                placeholder="Search">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn btn-block btn-lg btn-primary"><i class="fas fa-search"></i>
                            CARI</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
    <script>
        $(document).on("click", "a#import-data", function(e) {
            e.preventDefault();
            resetAllInputOnForm('#main-form');
            $('h4.modal-title').text('Upload');
            $('#add-modal').modal('show');
        });

        $(document).on("change", "#provinsi", function(e) {
            e.preventDefault()
            let provinsiId = this.value;
            let kabupatenSelect = document.getElementById('kabupaten');
            kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';

            if (!provinsiId) {
                return;
            }
            fetch('/api/kabupaten/' + provinsiId)
                .then(response => response.json())
                .then(data => {
                    data.forEach(item => {
                        var option = document.createElement('option');
                        option.value = item.id;
                        option.textContent = item.type + ' ' + item.name;
                        kabupatenSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error:', error));
        });
        $(document).on("change", "#kabupaten", function(e) {
            e.preventDefault()
            let kabupatenId = this.value;
            let kecamatanSelect = document.getElementById('kecamatan');
            kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';

            if (!kabupatenId) {
                return;
            }
            fetch('/api/kecamatan/' + kabupatenId)
                .then(response => response.json())
                .then(data => {
                    data.forEach(item => {
                        var option = document.createElement('option');
                        option.value = item.id;
                        option.textContent = item.name;
                        kecamatanSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error:', error));
        });
        $(document).on("change", "#kecamatan", function(e) {
            e.preventDefault()
            let kecamatanId = this.value;
            let kelurahanSelect = document.getElementById('kelurahan');
            kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';

            if (!kecamatanId) {
                return;
            }
            fetch('/api/kelurahan/' + kecamatanId)
                .then(response => response.json())
                .then(data => {
                    data.forEach(item => {
                        var option = document.createElement('option');
                        option.value = item.id;
                        option.textContent = item.name;
                        kelurahanSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error:', error));
        });
        $(document).on("click", "a#filter-data", function(e) {
            e.preventDefault();
            resetAllInputOnForm('#filter-form');
            $('h4.modal-title').text('Filter');
            $('#filter-modal').modal('show');
        });
        // --- Export Data ---
        $(document).on("click", "a#export-data", function(e) {
            e.preventDefault();
            var currentURL = window.location.href;
            var searchParams = new URLSearchParams(new URL(currentURL).search);

            var params = new URLSearchParams();
            params.append('search', searchParams.get('search') == null ? '' : searchParams.get('search'));
            params.append('provinsi', searchParams.get('provinsi') == null ? '' : searchParams.get('provinsi'));
            params.append('kabupaten', searchParams.get('kabupaten') == null ? '' : searchParams.get('kabupaten'));
            params.append('kecamatan', searchParams.get('kecamatan') == null ? '' : searchParams.get('kecamatan'));
            params.append('kelurahan', searchParams.get('kelurahan') == null ? '' : searchParams.get('kelurahan'));
            params.append('simpul', searchParams.get('simpul') == null ? '' : searchParams.get('simpul'));
            params.append('nik', 1);

            var queryString = params.toString();
            window.location.href = BASE_URL + '/export-peserta?' + queryString;
        });
        // --- Export tanpa NIK ---
        $(document).on("click", "a#export-data-tanpa-nik", function(e) {
            e.preventDefault();
            var currentURL = window.location.href;
            var searchParams = new URLSearchParams(new URL(currentURL).search);

            var params = new URLSearchParams();
            params.append('search', searchParams.get('search') == null ? '' : searchParams.get('search'));
            params.append('provinsi', searchParams.get('provinsi') == null ? '' : searchParams.get('provinsi'));
            params.append('kabupaten', searchParams.get('kabupaten') == null ? '' : searchParams.get('kabupaten'));
            params.append('kecamatan', searchParams.get('kecamatan') == null ? '' : searchParams.get('kecamatan'));
            params.append('kelurahan', searchParams.get('kelurahan') == null ? '' : searchParams.get('kelurahan'));
            params.append('simpul', searchParams.get('simpul') == null ? '' : searchParams.get('simpul'));
            params.append('nik', 0);

            var queryString = params.toString();
            window.location.href = BASE_URL + '/export-peserta?' + queryString;
        });
        // --- SUBMIT Filter ---
        $('form#filter-form').submit(function(e) {
            e.preventDefault();
            var form_data = new FormData(this);

            var params = new URLSearchParams();
            params.append('search', form_data.get('search'));
            params.append('provinsi', form_data.get('provinsi'));
            params.append('kabupaten', form_data.get('kabupaten'));
            params.append('kecamatan', form_data.get('kecamatan'));
            params.append('kelurahan', form_data.get('kelurahan'));
            params.append('simpul', form_data.get('simpul'));

            var queryString = params.toString();
            window.location.href = BASE_URL + '/peserta?' + queryString;
        });
        // --- SUBMIT FORM ---
        $('form#main-form').submit(function(e) {
            e.preventDefault();
            var form_data = new FormData(this);

            $.ajax({
                type: 'post',
                url: BASE_URL + "/import-peserta",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: form_data,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                beforeSend: function() {
                    showLoading('', '');
                },
                success: function(res) {
                    swal.close();
                    showAlertOnSubmit(res, '#add-modal', '', BASE_URL + '/peserta', );
                },
            })
        });
        $(document).on("click", "a#delete-data", function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            showDeletePopup(BASE_URL + '/peserta/' + id, '{{ csrf_token() }}', '', '',
                BASE_URL + '/peserta');
        });
    </script>
@endpush
