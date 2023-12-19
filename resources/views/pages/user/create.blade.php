@extends('layouts.app')

@section('title', $title)

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ $title }}</h1>
                @include('pages.user.breadcrumb')
            </div>

            <div class="section-body">

                <div class="card">
                    <form action="{{ route('user.store') }}" method="POST">
                        @csrf
                        <div class="card-header">
                            <h4>{{ $title }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group mb-2">
                                        <label>Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" value="{{ old('name') }}" autocomplete="off">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-2">
                                                <label>Email</label>
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                                    value="{{ old('email') }}" autocomplete="off">
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-2">
                                                <label>Phone</label>
                                                <input type="text"
                                                    class="form-control @error('phone') is-invalid @enderror" name="phone"
                                                    value="{{ old('phone') }}" autocomplete="off">
                                                @error('phone')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-2">
                                        <label class="form-label">Roles</label>
                                        <div class="selectgroup w-100">
                                            <label class="selectgroup-item">
                                                <input type="radio" name="roles" value="admin"
                                                    class="selectgroup-input">
                                                <span class="selectgroup-button">Admin</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" name="roles" value="daengfaqih"
                                                    class="selectgroup-input" checked="">
                                                <span class="selectgroup-button">Pemilih Daeng Faqih</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" name="roles" value="anjar"
                                                    class="selectgroup-input" checked="">
                                                <span class="selectgroup-button">Pemilih Anjar</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-2">
                                        <label>Username</label>
                                        <input id="username" type="text"
                                            class="form-control @error('username') is-invalid @enderror" name="username"
                                            value="{{ old('username') }}" autocomplete="off">
                                        @error('username')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-2">
                                        <label>Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            name="password">
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-lg btn-primary"><i class="fas fa-save"></i> SIMPAN</button>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#username').on('input', function() {
                var inputValue = $(this).val();
                inputValue = inputValue.toLowerCase();
                inputValue = inputValue.replace(/[^a-z0-9]/g, '.');
                $(this).val(inputValue);
            });
        });
    </script>
@endpush
