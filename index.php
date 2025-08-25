<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Soccer — Website by Colorlib</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

  <!-- Icons & Fonts -->
  <link rel="stylesheet" href="assets/fonts/icomoon/style.css">
  <link rel="stylesheet" href="assets/fonts/flaticon/font/flaticon.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="assets/css/bootstrap/bootstrap.css">
  <link rel="stylesheet" href="assets/css/jquery-ui.css">
  <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
  <link rel="stylesheet" href="assets/css/jquery.fancybox.min.css">
  <link rel="stylesheet" href="assets/css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="assets/css/aos.css">

  <!-- Main CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="index-page">

  <!-- Header -->
  <?php include 'inc/header.php'; ?>

  <!-- Main Content -->
  <main class="main">
    <?php 
      $page = isset($_GET['page']) ? $_GET['page'] : 'home';
      $file = "content/" . $page . ".php";
      if (file_exists($file)) {
          include $file;
      } else {
          include 'content/notfound.php';
      }
    ?>
  </main>

  <!-- Footer -->
  <?php include 'inc/footer.php'; ?>

  <!-- Scripts -->
  <script src="assets/js/jquery-3.3.1.min.js"></script>
  <script src="assets/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="assets/js/jquery-ui.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/owl.carousel.min.js"></script>
  <script src="assets/js/jquery.stellar.min.js"></script>
  <script src="assets/js/jquery.countdown.min.js"></script>
  <script src="assets/js/bootstrap-datepicker.min.js"></script>
  <script src="assets/js/jquery.easing.1.3.js"></script>
  <script src="assets/js/aos.js"></script>
  <script src="assets/js/jquery.fancybox.min.js"></script>
  <script src="assets/js/jquery.sticky.js"></script>
  <script src="assets/js/jquery.mb.YTPlayer.min.js"></script>

  <!-- Custom Script -->
  <script src="assets/js/main.js"></script>

</body>
</html>
