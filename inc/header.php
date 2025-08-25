<header class="site-navbar py-4" role="banner">
  <div class="container">
    <div class="d-flex align-items-center">
      
      <!-- Logo -->
      <div class="site-logo">
        <a href="index.php">
          <img src="assets/images/logo.png" alt="Logo">
        </a>
      </div>

      <!-- Navigation -->
      <div class="ms-auto">
        <nav class="site-navigation position-relative text-end" role="navigation">
          <ul class="site-menu main-menu js-clone-nav me-auto d-none d-lg-block">
            <?php
              // Ambil page dari GET, default 'home'
              $page = isset($_GET['page']) ? $_GET['page'] : 'home';

              // Daftar menu
              $menus = [
                "home"     => ["label" => "Home",     "url" => "index.php?page=home"],
                "matches"  => ["label" => "Matches",  "url" => "index.php?page=matches"],
                "players"  => ["label" => "Players",  "url" => "index.php?page=players"],
                "blog"     => ["label" => "Blog",     "url" => "index.php?page=blog"],
                "contact"  => ["label" => "Contact",  "url" => "index.php?page=contact"],
              ];

              // Loop menu
              foreach ($menus as $key => $menu) {
                $active = ($page === $key) ? "active" : "";
                echo '
                  <li class="'.$active.'">
                    <a href="'.$menu['url'].'" class="nav-link">'.$menu['label'].'</a>
                  </li>
                ';
              }
            ?>
          </ul>
        </nav>

        <!-- Mobile Menu Toggle -->
        <a href="#" 
           class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-white float-end">
          <span class="icon-menu h3"></span>
        </a>
      </div>

    </div>
  </div>
</header>
