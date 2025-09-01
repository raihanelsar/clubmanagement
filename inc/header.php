<header id="header" class="header d-flex align-items-center px-3 px-md-4 py-2 shadow-sm bg-white position-fixed top-0 start-0 end-0 z-3">
  <!-- Toggle untuk mobile -->
  <i class="header-toggle d-xl-none bi bi-list fs-4 me-2 cursor-pointer text-primary"
     role="button" aria-label="Toggle navigation"></i>

  <!-- Logo / Brand -->
  <a class="navbar-brand fw-bold text-primary d-block" href="?page=home">
    <span class="d-none d-md-inline">SoccerHub</span>
    <span class="d-md-none">SH</span>
  </a>

  <!-- Navigasi Utama -->
  <nav id="navmenu" class="navmenu ms-auto">
    <ul class="d-flex flex-row gap-1 mb-0 list-unstyled">
      <?php
      $page = isset($_GET['page']) ? $_GET['page'] : 'home';

      $menus = [
        'home' => [
          'url' => '?page=home',
          'label' => 'Home'
        ],
        'office' => [
          'url' => '?page=office',
          'label' => 'Office'
        ],
        'squad' => [
          'url' => '?page=squad',
          'label' => 'Squad'
        ],
        'transfers' => [
          'url' => '?page=transfers',
          'label' => 'Transfers'
        ],
      ];

      foreach ($menus as $key => $menu):
        // Gunakan str_starts_with jika PHP 8+, fallback ke strpos untuk versi lama
        $isActive = function_exists('str_starts_with')
          ? str_starts_with($page, $key)
          : strpos($page, $key) === 0;
      ?>
        <li>
          <a href="<?= htmlspecialchars($menu['url']) ?>"
             class="nav-link px-3 py-2 rounded <?= $isActive ? 'text-white bg-primary fw-medium' : 'text-dark' ?>"
             aria-current="<?= $isActive ? 'page' : '' ?>">
            <?= htmlspecialchars($menu['label']) ?>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </nav>
</header>

<style>
  .nav-link {
    transition: all 0.2s ease;
  }
  .nav-link:hover {
    background: #f1f3f5;
    color: #0d6efd !important;
  }
</style>
