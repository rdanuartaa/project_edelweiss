<!DOCTYPE html>
<html lang="en">
@include('admin.layouts.head')

<body>
    @include('admin.layouts.navbar')
    @include('admin.layouts.sidebar')
    <div class="dashboard-main-body">
        @yield('content')
    </div>
    @include('admin.layouts.script')
</body>

</html>
