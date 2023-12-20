<div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
    <div class="breadcrumb-item"><a href="{{ route('penduduk.index') }}">penduduk</a></div>
    @if (Request::is('*create'))
        <div class="breadcrumb-item">penduduk Baru</div>
    @elseif (Request::is('*edit'))
        <div class="breadcrumb-item">Edit penduduk</div>
    @else
        <div class="breadcrumb-item d-none"></div>
    @endif
</div>
