
<!DOCTYPE html>
<html lang="en">
  <head>
    @include('includes.meta')
    @include('includes.styles')
    @stack('after-styles')
  </head>
  <body class="hold-transition login-page">
    
    @yield('content')

    @include('includes.scripts')
    @stack('after-scripts')
  </body>
</html>
