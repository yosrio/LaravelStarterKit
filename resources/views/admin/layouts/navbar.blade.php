<!-- Left navbar links -->
<ul class="navbar-nav">
  <li class="nav-item">
    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
      <i class="fas fa-bars"></i>
    </a>
    <li class="nav-item d-none d-sm-inline-block">
      <a class="nav-link">
        <span id="clock"></span>
      </a>
    </li>
  </li>
</ul>
<ul class="navbar-nav ml-auto">
  <li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
      <span class="">{{ $currentUser->name }}</span>
      &nbsp;&nbsp;
      <i class="fas fa-user"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
      <a href="{{ route('profile') }}" class="dropdown-item">
        <i class="fas fa-user-cog mr-2"></i> Profile Settings
      </a>
      <div class="dropdown-divider"></div>
      <a href="{{ route('logout') }}" class="dropdown-item">
        <i class="fas fa-sign-out-alt mr-2"></i> Logout
      </a>
      <div class="dropdown-divider"></div>
    </div>
  </li>
</ul>

@section('scripts')
@endsection