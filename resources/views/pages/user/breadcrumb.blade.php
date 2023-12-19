<div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
    <div class="breadcrumb-item"><a href="{{ route('user.index') }}">Users</a></div>
    @if (Request::is('*create'))
    <div class="breadcrumb-item">New User</div>
    @elseif (Request::is('*edit'))
    <div class="breadcrumb-item">Edit User</div>
    @else
    <div class="breadcrumb-item d-none"></div>
    @endif
</div>