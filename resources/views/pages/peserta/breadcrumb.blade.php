<div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
    <div class="breadcrumb-item"><a href="{{ route('peserta.index') }}">Peserta</a></div>
    @if (Request::is('*create'))
        <div class="breadcrumb-item">Peserta Baru</div>
    @elseif (Request::is('*edit'))
        <div class="breadcrumb-item">Edit Peserta</div>
    @else
        <div class="breadcrumb-item d-none"></div>
    @endif
</div>
