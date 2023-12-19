@extends('layouts.app-relasi')
@section('title', $title)
@push('style')
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
@endpush

@section('main')
    <section class="section">
        <div class="row">
            <div class="col-12 text-center">
                <img src="{{ asset('img/logo-pkh.jpeg') }}" class="img-fluid"
                    style="height: 170px; width:auto; margin-top: 0px" alt="">
                @include('layouts.alert')
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-3">
                <form action="{{ route('home') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <h2 class="text-center">{{ $title }}</h2>
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama Lengkap Sesuai KTP</label>
                                <input name="nama" type="text"
                                    class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}">
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Nomor Induk Kependudukan (NIK)</label>
                                <div class="input-group">
                                    <input name="nik" id="nik" type="text"
                                        class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text p-0">
                                            <a type="button" id="cek-nik" class="btn btn-sm btn-danger m-0">Cek NIK</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nomor Telp/WA</label>
                                <input name="telpon" type="text"
                                    class="form-control @error('telpon') is-invalid @enderror" value="{{ old('telpon') }}">
                                @error('telpon')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <input name="alamat" type="text"
                                    class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat') }}">
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
                                            value="{{ old('rt') }}">
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
                                            value="{{ old('rw') }}">
                                        @error('rw')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Provinsi</label>
                                <select class="form-control select2  @error('provinsi_id') is-invalid @enderror"
                                    name="provinsi_id" id="provinsi">
                                    <option value="">- pilih Provinsi -</option>
                                    @foreach ($provinsi as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('provinsi_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Kabupaten/Kota</label>
                                <select class="form-control select2 @error('kabupaten_id') is-invalid @enderror"
                                    name="kabupaten_id" id="kabupaten">
                                </select>
                                @error('kabupaten_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Kecamatan</label>
                                <select class="form-control select2 @error('kecamatan_id') is-invalid @enderror"
                                    name="kecamatan_id" id="kecamatan">
                                </select>
                                @error('kecamatan_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Kelurahan</label>
                                <select class="form-control select2 @error('kelurahan_id') is-invalid @enderror"
                                    name="kelurahan_id" id="kelurahan">
                                </select>
                                @error('kelurahan_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="form-control btn btn-primary btn-lg" value="Kirim Pendaftaran">
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection
@push('scripts')
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>

    <script type="text/javascript">
        $(document).on("change", "#select-dante", function(e) {
            e.preventDefault()
            let danteId = this.value;

            if (danteId == 0) {
                $("#dante-lain").removeClass('d-none').val('')
            } else {
                $("#dante-lain").addClass('d-none')
            }
        })
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
    </script>
@endpush
