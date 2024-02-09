<a href="{{ route('dashboard') }}" class="brand-link" style="text-decoration: none;">
  <img src="{{ asset('admin/assets/dist/img/laravel.svg') }}" alt="{{ $adminPageTitle->value ?? 'Laravel Admin' }}" class="brand-image">
  <span class="brand-text font-weight-light">{{ $adminPageTitle->value ?? 'Laravel Admin' }}</span>
</a>
<div class="sidebar">
  <!-- <div class="form-inline">
    <div class="input-group" data-widget="sidebar-search">
      <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
      <div class="input-group-append">
        <button class="btn btn-sidebar">
          <i class="fas fa-search fa-fw"></i>
        </button>
      </div>
    </div>
  </div> -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      @foreach ($menuList as $item)
        @php
          $permission = json_decode($currentUserRole['permission'], 1);
          if (!array_key_exists(strtolower($item->menu_group), $permission)) {
              continue;
          }
          $menuItem = json_decode($item->menu_item, 1);
        @endphp
        <li class="nav-item">
          <a href="{{ $menuItem['route'] == '#' ? $menuItem['route'] : route($menuItem['route']) }}" class="nav-link">
            <i class="{{ $menuItem['icon'] }} nav-icon"></i>
            <p>{{ $menuItem['menu_title'] }}
              @if (array_key_exists('items', $menuItem))
                <i class="right fas fa-angle-left"></i>
              @endif
            </p>
          </a>
          @if (array_key_exists('items', $menuItem))
            @foreach ($menuItem['items'] as $menu)
              @php
                $permissionItem = $permission[strtolower($item->menu_group)];
              @endphp
              @if (!in_array($menu['menu_id'], $permissionItem))
                @php
                  continue;
                @endphp
              @endif
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route($menu['route']) }}" class="nav-link">
                    <i class="{{ $menu['icon'] }} nav-icon"></i>
                    <p>{{ $menu['menu_title'] }}</p>
                  </a>
                </li>
              </ul>
            @endforeach
          @endif
        </li>
      @endforeach
    </ul>
  </nav>
</div>