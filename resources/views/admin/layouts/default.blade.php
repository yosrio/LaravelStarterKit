<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $appName->value ?? 'Laravel Starter Kit' }}</title>
  <link rel="icon" href="{{ $favicon->value != '' ? asset('storage/'.$favicon->value) : asset('admin/assets/dist/img/laravel.png') }}" type="image/x-icon">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset('admin/assets/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ asset('admin/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/assets/plugins/jqvmap/jqvmap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/assets/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/assets/plugins/daterangepicker/daterangepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/assets/plugins/summernote/summernote-bs4.min.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
  @yield('css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        @include('admin.layouts.navbar')
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        @include('admin.layouts.sidebar')
    </aside>

    <div class="content-wrapper" style="background-color: white;">
      @yield('content')
    </div>

    <!-- <footer class="main-footer">
        @include('admin.layouts.footer')
    </footer> -->
  </div>

  <script src="{{ asset('admin/assets/plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('admin/assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <script src="{{ asset('admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('admin/assets/plugins/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('admin/assets/plugins/sparklines/sparkline.js') }}"></script>
  <script src="{{ asset('admin/assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
  <script src="{{ asset('admin/assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
  <script src="{{ asset('admin/assets/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
  <script src="{{ asset('admin/assets/plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('admin/assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
  <script src="{{ asset('admin/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
  <script src="{{ asset('admin/assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
  <script src="{{ asset('admin/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
  <script src="{{ asset('admin/assets/dist/js/adminlte.js') }}"></script>
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
  <!-- In your Blade view or layout file -->
  <script>
      var laravelTimezone = "{{ config('app.timezone') }}";
  </script>

  <!-- In the same file or another script file -->
  <script>
      function updateClock() {
          var serverTime = new Date().toLocaleString('en-US', { timeZone: laravelTimezone, timeStyle: 'short' });
          document.getElementById('clock').textContent = serverTime;
      }

      // Update the clock every second
      setInterval(updateClock, 1000);

      // Initial update
      updateClock();
  </script>
  @yield('scripts')
</body>
</html>
