<aside id="sidebar" class="sidebar bg-dark text-white vh-100 shadow-sm">

  <ul class="sidebar-nav list-unstyled" id="sidebar-nav">

    <!-- Dashboard -->
    <li class="nav-item">
      <a href="?page=dashboard" 
         class="nav-link d-flex align-items-center gap-2 px-3 py-2 rounded active">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <!-- Office -->
    <li class="nav-item">
      <a class="nav-link collapsed d-flex align-items-center gap-2 px-3 py-2 rounded"
         data-bs-toggle="collapse" href="#office-nav" aria-expanded="false">
        <i class="bi bi-menu-button-wide"></i>
        <span>Office</span>
        <i class="bi bi-chevron-down ms-auto toggle-icon"></i>
      </a>
      <ul id="office-nav" class="nav-content collapse list-unstyled ms-4">
        <li><a href="?page=objectives"><i class="bi bi-circle"></i> Objectives</a></li>
        <li><a href="?page=career-summary"><i class="bi bi-circle"></i> Career</a></li>
        <li><a href="?page=season-stats"><i class="bi bi-circle"></i> Season Stats</a></li>
        <li><a href="?page=head-to-head"><i class="bi bi-circle"></i> Head 2 Head</a></li>
        <li><a href="?page=fixtures"><i class="bi bi-circle"></i> Fixtures</a></li>
        <li><a href="?page=tournaments"><i class="bi bi-circle"></i> Tournaments</a></li>
        <li><a href="?page=teams"><i class="bi bi-circle"></i> Teams</a></li>
      </ul>
    </li>

    <!-- Squad -->
    <li class="nav-item">
      <a class="nav-link collapsed d-flex align-items-center gap-2 px-3 py-2 rounded"
         data-bs-toggle="collapse" href="#squad-nav" aria-expanded="false">
        <i class="bi bi-people"></i>
        <span>Squad</span>
        <i class="bi bi-chevron-down ms-auto toggle-icon"></i>
      </a>
      <ul id="squad-nav" class="nav-content collapse list-unstyled ms-4">
        <li><a href="?page=squad-hub"><i class="bi bi-circle"></i> Squad Hub</a></li>
        <li><a href="?page=training-plan"><i class="bi bi-circle"></i> Training Plan</a></li>
      </ul>
    </li>

    <!-- Transfers -->
    <li class="nav-item">
      <a class="nav-link collapsed d-flex align-items-center gap-2 px-3 py-2 rounded"
         data-bs-toggle="collapse" href="#transfers-nav" aria-expanded="false">
        <i class="bi bi-arrow-left-right"></i>
        <span>Transfers</span>
        <i class="bi bi-chevron-down ms-auto toggle-icon"></i>
      </a>
      <ul id="transfers-nav" class="nav-content collapse list-unstyled ms-4">
        <li><a href="?page=transfer-hub"><i class="bi bi-circle"></i> Transfer Hub</a></li>
        <li><a href="?page=scout"><i class="bi bi-circle"></i> Scout</a></li>
        <li><a href="?page=search-player"><i class="bi bi-circle"></i> Search Player</a></li>
      </ul>
    </li>

    <!-- Pages -->
    <li class="nav-heading text-uppercase small fw-bold text-secondary mt-3">Pages</li>
    <li>
      <a href="?page=user" class="nav-link d-flex align-items-center gap-2 px-3 py-2 rounded">
        <i class="bi bi-person"></i> User
      </a>
    </li>
    <li>
      <a href="?page=setting" class="nav-link d-flex align-items-center gap-2 px-3 py-2 rounded">
        <i class="bi bi-gear"></i> Setting
      </a>
    </li>

  </ul>

</aside>

<style>
  .sidebar {
    width: 240px;
    position: fixed;
    top: 60px; /* header height */
    left: 0;
    overflow-y: auto;
    transition: all 0.3s;
  }

  .sidebar .nav-link {
    color: #adb5bd;
    font-weight: 500;
    transition: all 0.3s;
  }

  .sidebar .nav-link:hover,
  .sidebar .nav-link.active {
    background: #0d6efd;
    color: #fff;
  }

  .sidebar .nav-content a {
    padding: 6px 0 6px 20px;
    font-size: 14px;
    color: #adb5bd;
    display: block;
    transition: all 0.3s;
  }

  .sidebar .nav-content a:hover {
    color: #fff;
  }

  .toggle-icon {
    transition: transform 0.3s;
  }

  .nav-link[aria-expanded="true"] .toggle-icon {
    transform: rotate(180deg);
  }
</style>
