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
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <div class="card">
                    <form action="{{ route('profil-bisnis.update', $profilBisnis) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label>ID Masjid/Musholla</label>
                                        <input type="text" class="form-control @error('id_client') is-invalid @enderror"
                                            name="id_client" value="{{ old('id_client', $profilBisnis->id_client) }}"
                                            autocomplete="off">
                                        @error('id_client')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-2">
                                        <label>Nama Masjid/Musholla</label>
                                        <input type="text"
                                            class="form-control @error('nama_client') is-invalid @enderror"
                                            name="nama_client" value="{{ old('nama_client', $profilBisnis->nama_client) }}"
                                            autocomplete="off">
                                        @error('nama_client')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-2">
                                        <label>Alamat</label>
                                        <textarea class="form-control @error('alamat_client') is-invalid @enderror" data-height="90" name="alamat_client">{{ old('alamat_client', $profilBisnis->alamat_client) }}</textarea>
                                        @error('alamat_client')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-2">
                                        <label>Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email', $profilBisnis->email) }}"
                                            autocomplete="off">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-2">
                                        <label>Ketua Takmir</label>
                                        <input type="text" class="form-control @error('signature') is-invalid @enderror"
                                            name="signature" value="{{ old('signature', $profilBisnis->signature) }}"
                                            autocomplete="off">
                                        @error('signature')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label>Provinsi</label>
                                        <select class="form-control select2" name="provinsi_id" id="provinsi">
                                            <option value="0">- pilih Provinsi -</option>
                                            @foreach ($provinsi as $item)
                                                <option value="{{ $item->id }}" {{ $item->id == $profilBisnis->provinsi_id ? 'selected' : '' }}>
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
                                                    {{ $item->id == $profilBisnis->kabupaten_id ? 'selected' : '' }}>
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
                                                    {{ $item->id == $profilBisnis->kecamatan_id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- <div class="form-group mb-2">
                                        <label>Kelurahan</label>
                                        <select class="form-control select2" name="kelurahan_id" id="kelurahan">
                                            @foreach ($kelurahan as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id == $pemilih->kelurahan_id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div> --}}
                                    <div class="form-group mb-2">
                                        <label>Logo</label>
                                        <div id="image-preview"
                                            class="image-preview @if (session('error')) is-invalid @endif">
                                            <label id="image-label">Choose File</label>
                                            <input type="file" name="logo" id="image-upload" />
                                            <img src="{{ Storage::url($profilBisnis->logo) }}"
                                                class="img-fluid image-tampil" alt="">
                                        </div>
                                        @if (session('error'))
                                            <div class="invalid-feedback">
                                                {{ session('error') }}
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer text-right">
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
    <script>
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
    </script>
@endpush
