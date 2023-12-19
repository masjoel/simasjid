@extends('layouts.beranda')
@section('title', $title)
@push('style')
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
@endpush

@section('main')
    <section class="section">
        <div class="row">
            <div class="col-12">
                @include('layouts.alert')
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-5">
                <form action="{{ route('ceknik') }}" method="get" enctype="multipart/form-data">
                    @csrf
                    <h2>{{ $title }}</h2>
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>NIK</label>
                                <textarea name="search" class="form-control" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="form-control btn btn-primary btn-lg" value="Cek NIK">
                    </div>
                </form>
                <!-- ceknomor.php -->

                @if (isset($members) && count($members) > 0)
                    <h2>Hasil Pencarian</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>NIK</th>
                                <th>Nama</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($members as $index => $item)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $item->nik }}</td>
                                    <td>{{ $item->nama }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Tidak ada hasil yang ditemukan! atau {{ $msg }}</p>
                @endif

            </div>
        </div>
    </section>

@endsection
@push('scripts')
    {{-- <script src="{{ asset('js/custom-upload-preview.js') }}"></script>
    <script src="{{ asset('library/upload-preview/upload-preview.js') }}"></script>
    <script src="{{ asset('js/page/features-post-create.js') }}"></script> --}}
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>

    <script type="text/javascript">
        $(document).on("change", "#select-cara_voting", function(e) {
            e.preventDefault()
            let caraId = this.value;

            if (caraId == 0) {
                $("#cara_voting-lain").removeClass('d-none').val('')
            } else {
                $("#cara_voting-lain").addClass('d-none')
            }
        })
    </script>
@endpush
