<!DOCTYPE html>
<html lang="en">
@include('main.layouts.head')

<body>
    <div class="main-wrapper">
        @include('main.layouts.preloader')
        @include('main.layouts.navbar')
        @yield('content')
        @include('main.layouts.footer')
    </div>
    @include('main.layouts.script')
</body>

</html>
