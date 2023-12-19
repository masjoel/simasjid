@extends('layouts.auth')

@section('title', 'Login')

@push('style')
    <link rel="stylesheet" href="{{ asset('library/bootstrap-social/bootstrap-social.css') }}">
@endpush

@section('main')
    <div class="card card-primary">
        <div class="card-header">
            <h4><a href="{{ route('home') }}" class="float-left badge badge-primary p-1 mr-2"><i class="fas fa-arrow-left"></i></a>Login</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                @csrf
                <div class="form-group">
                    <label for="email">{{ __('Email or Username') }}</label>
                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" tabindex="1" value="{{ old('email') }}" autocomplete="off" autofocus>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="d-block">
                        <label for="password" class="control-label">Password</label>
                        <div class="float-right">
                            <a href="{{ route('password.request') }}" class="text-small">
                                Forgot Password?
                            </a>
                        </div>
                    </div>
                    <input id="password" type="password"
                        class="form-control @error('password')
                        is-invalid
                    @enderror"
                        name="password" tabindex="2">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Login
                    </button>
                </div>
                {{-- Belum punya akun? <a href="{{ route('register') }}">Buat baru</a> --}}
            </form>

        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
