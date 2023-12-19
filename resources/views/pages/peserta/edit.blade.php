@extends('layouts.app')

@section('title', ucwords(auth()->user()->name))

@push('style')
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ $title }}</h1>
                @include('pages.peserta.breadcrumb')
            </div>

            <div class="section-body">

                <div class="card">
                    <form action="{{ route('peserta.update', $pemilih) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label>Nama Lengkap Sesuai KTP</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            name="nama" value="{{ old('nama', $pemilih->nama) }}" autocomplete="off">
                                        @error('nama')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-2">
                                        <label>Nomor Induk Kependudukan (NIK)</label>
                                        <input type="text" class="form-control @error('nik') is-invalid @enderror"
                                            name="nik" value="{{ old('nik', $pemilih->nik) }}" autocomplete="off">
                                        @error('nik')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-2">
                                        <label>Nomor Telp/WA</label>
                                        <input type="text" class="form-control @error('telpon') is-invalid @enderror"
                                            name="telpon" value="{{ old('telpon', $pemilih->telpon) }}" autocomplete="off">
                                        @error('telpon')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-2">
                                        <label>Alamat</label>
                                        <input name="alamat" type="text"
                                            class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat', $pemilih->alamat) }}">
                                        @error('alamat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>RT</label>
                                                <input name="rt" type="text"
                                                    class="form-control @error('rt') is-invalid @enderror"
                                                    value="{{ old('rt', $pemilih->rt) }}">
                                                @error('rt')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>RW</label>
                                                <input name="rw" type="text"
                                                    class="form-control @error('rw') is-invalid @enderror"
                                                    value="{{ old('rw', $pemilih->rw) }}">
                                                @error('rw')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label>Provinsi</label>
                                        <select class="form-control select2" name="provinsi_id" id="provinsi">
                                            <option value="0">- pilih Provinsi -</option>
                                            @foreach ($provinsi as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id == $pemilih->provinsi_id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label>Kabupaten/Kota</label>
                                        <select class="form-control select2" name="kabupaten_id" id="kabupaten">
                                            @foreach ($kabupaten as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id == $pemilih->kabupaten_id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mb-2">
                                        <label>Kecamatan</label>
                                        <select class="form-control select2" name="kecamatan_id" id="kecamatan">
                                            @foreach ($kecamatan as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id == $pemilih->kecamatan_id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label>Kelurahan</label>
                                        <select class="form-control select2" name="kelurahan_id" id="kelurahan">
                                            @foreach ($kelurahan as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id == $pemilih->kelurahan_id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-lg btn-primary"><i class="fas fa-save"></i>
                                SIMPAN</button>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('library/upload-preview/upload-preview.js') }}"></script>
    <script src="{{ asset('js/page/features-post-create.js') }}"></script>
    <script src="{{ asset('library/sweetalert2/sweetalert2.min.js') }}"></script>

    <script type="text/javascript">
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
        // document.getElementById('Xprovinsi').addEventListener('change', function() {
        //     var provinsiId = this.value;
        // });
    </script>
@endpush
