<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.meta')
    @include('includes.styles')
    @stack('after-styles')
</head>

<body class="sidebar-mini layout-fixed">
    @include('includes.navbar')
    @include('includes.sidebar')

    <div class="content-wrapper">
        <div class="content">
            <div class="container-fluid py-4 px-md-3">
                @yield('content')
            </div>
        </div>
    </div>

    @include('includes.scripts')
    @stack('after-scripts')
</body>

</html>
