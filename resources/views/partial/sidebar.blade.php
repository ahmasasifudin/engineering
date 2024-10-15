<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="/">
        <i class="typcn typcn-device-desktop menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    @if (Auth::user()->isAdmin())
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#data-master" aria-expanded="false" aria-controls="data-master">
        <i class="typcn typcn-document-text menu-icon"></i>
        <span class="menu-title">Data Master</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="data-master">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="/material">Data Material</a></li>
          <li class="nav-item"> <a class="nav-link" href="/supplier">Data Supplier</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/schedule">
        <i class="typcn typcn-calendar menu-icon"></i>
        <span class="menu-title">Schedule Pengujian</span>
      </a>
    </li>
    @endif
    <li class="nav-item">
      <a class="nav-link" href="/report">
        <i class="typcn typcn-book menu-icon"></i>
        <span class="menu-title">Report Pengujian</span>
      </a>
    </li>
  </ul>
</nav>