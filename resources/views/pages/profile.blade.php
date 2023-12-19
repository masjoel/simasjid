@extends('layouts.app')

@section('title', 'Profile')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-social/assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Profile</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Profile</div>
                </div>
            </div>
            <div class="section-body">

                <div class="row mt-sm-4">
                    <div class="col-12 col-md-12 col-lg-5">
                        <div class="card profile-widget">
                            <div class="profile-widget-header">
                                <img alt="image"
                                    src="{{ auth()->user()->avatar ? Storage::url(auth()->user()->avatar) : asset('img/avatar/avatar-1.png') }}"
                                    class="rounded-circle profile-widget-picture">
                                <div class="profile-widget-items">
                                    {{-- <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Posts</div>
                                    <div class="profile-widget-item-value">187</div>
                                </div>
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Followers</div>
                                    <div class="profile-widget-item-value">6,8K</div>
                                </div>
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Following</div>
                                    <div class="profile-widget-item-value">2,1K</div>
                                </div> --}}
                                </div>
                            </div>
                            <div class="profile-widget-description">
                                <div class="profile-widget-name">{{ auth()->user()->name }}
                                    <div class="text-muted d-inline font-weight-normal">
                                        {{-- <div class="slash"></div> Web Developer --}}
                                    </div>
                                </div>
                                <span class="text-success">{!! auth()->user()->username !!}</span>
                            </div>
                        </div>
                        <div class="card">
                            <form method="post" action="{{ route('user-password.update') }}" class="needs-validation"
                                novalidate="">
                                @csrf
                                @method('PUT')
                                <div class="card-header">
                                    <h4>Edit Password</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-5 col-12">
                                            <label>Current Pasword</label>
                                            <input type="password"
                                                class="form-control @error('current_password', 'updatePassword')
                                                is-invalid
                                            @enderror"
                                                name="current_password">
                                            @error('current_password', 'updatePassword')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                            <label>New Password</label>
                                            <input type="password" name='password'
                                                class="form-control @error('password', 'updatePassword')
                                                is-invalid
                                            @enderror">
                                            @error('password', 'updatePassword')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label>Password Confirmation</label>
                                            <input type="password" class="form-control" name='password_confirmation'>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-lg btn-primary" type="submit">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-7">
                        <div class="card">
                            <form method="post" action="{{ route('user-profile-information.update') }}"
                                class="needs-validation" novalidate="" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" name='name'
                                                    class="form-control @error('name', 'updateProfileInformation')
                                                is-invalid
                                            @enderror"
                                                    value="{{ old('name', auth()->user()->name) }}">
                                                @error('name', 'updateProfileInformation')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email"
                                                    class="form-control @error('email', 'updateProfileInformation')
                                            is-invalid
                                            @enderror"
                                                    name='email' value="{{ old('name', auth()->user()->email) }}"
                                                    required="">
                                                @error('email', 'updateProfileInformation')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input type="tel"
                                                    class="form-control @error('phone', 'updateProfileInformation')
                                                is-invalid
                                            @enderror"
                                                    value="{{ old('name', auth()->user()->phone) }}" name="phone">
                                                @error('phone', 'updateProfileInformation')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-2">
                                                <label>Avatar</label>
                                                <div id="image-preview"
                                                    class="image-preview @error('avatar', 'updateProfileInformation') is-invalid @enderror">
                                                    <label id="image-label">Choose File</label>
                                                    <input type="file" name="avatar" id="image-upload" />
                                                    <img src="{{ Storage::url(auth()->user()->avatar) }}"
                                                        class="img-fluid image-tampil" alt="">
                                                </div>
                                                @error('avatar', 'updateProfileInformation')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        {{-- <div class="form-group">
                                            <label>Bio</label>
                                            <textarea class="form-control summernote-simple" name="bio">{{ old('name', auth()->user()->bio) }}</textarea>
                                        </div> --}}
                                        <input type="hidden" name="bio">
                                        <div class="form-group text-right mt-5">
                                            <button class="btn btn-lg btn-primary" type="submit">Save Changes</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
    <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
    <script src="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('library/upload-preview/upload-preview.js') }}"></script>
    <script src="{{ asset('js/page/features-post-create.js') }}"></script>
    <script src="{{ asset('library/sweetalert2/sweetalert2.min.js') }}"></script>


    <!-- Page Specific JS File -->
@endpush
