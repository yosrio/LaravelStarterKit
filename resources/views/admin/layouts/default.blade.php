<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset('admin/assets/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ asset('admin/assets/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        @include('admin.layouts.navbar')
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        @include('admin.layouts.sidebar')
    </aside>

    <div class="content-wrapper">
      @yield('content')
    </div>

    <footer class="main-footer">
        @include('admin.layouts.footer')
    </footer>
  </div>

  <script src="{{ asset('admin/assets/plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('admin/assets/dist/js/adminlte.js') }}"></script>
  <script src="{{ asset('admin/assets/plugins/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('admin/assets/dist/js/pages/dashboard3.js') }}"></script>
</body>
</html>
