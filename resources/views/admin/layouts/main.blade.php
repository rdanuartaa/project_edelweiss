<!DOCTYPE html>
<html lang="en">
@include('admin.layouts.head')

<body>
    @include('admin.layouts.navbar')
    @include('admin.layouts.sidebar')
    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">{{ $pageTitle ?? 'Judul Halaman' }}</h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="{{ route('admin.dashboard.index') }}"
                        class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Dashboard
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">{{ $breadcrumb ?? 'Breadcrumb' }}</li>
            </ul>
        </div>
        @yield('content')
    </div>
    @include('admin.layouts.script')
    @stack('script')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: '{{ session('error') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            @endif
        });
    </script>
</body>

</html>
