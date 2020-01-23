<aside id="sidebar-wrapper">
  <div class="sidebar-brand">
    <a href="">{{ env('APP_NAME') }}</a>
  </div>
  <div class="sidebar-brand sidebar-brand-sm">
    <a href="#">{{ strtoupper(substr(env('APP_NAME'), 0, 2)) }}</a>
  </div>
  <ul class="sidebar-menu">
    <li class="menu-header">Dashboard</li>
    <li class="{{set_active('home')}}"><a class="nav-link" href="{{ route('home') }}"><i class="fa fa-columns"></i> <span>Dashboard</span></a></li>
    <li class="menu-header">Server Config</li>
    <li class="{{set_active(['logger.index','logger.create','logger.show'])}}"><a class="nav-link" href="{{route('logger.index')}}"><i class="fa fa-plus"></i> <span>Add Log</span></a></li>
  </ul>
</aside>
