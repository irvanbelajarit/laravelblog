<!doctype html>
<html lang="en" data-bs-theme="auto">
@include('backend.layouts.header')

<body>

    <div class="container-fluid">
        <div class="row">

            @include('backend.layouts.sidebar')

            @yield('content')
        </div>
    </div>


    @include('backend.layouts.footer')


</body>

</html>
