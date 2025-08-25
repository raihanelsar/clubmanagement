<?php include 'koneksi.php'; ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>office</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <style>
    body {
      background: #f8f9fa;
    }
    .dashboard-card {
      transition: transform 0.2s, box-shadow 0.2s;
      cursor: pointer;
    }
    .dashboard-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 6px 18px rgba(0,0,0,0.15);
    }
    .icon-circle {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 28px;
      color: white;
      margin-bottom: 15px;
    }
  </style>
</head>
<body class="p-4">
  <div class="container">
    <h1 class="mb-5 text-center fw-bold">Office Dashboard</h1>
    <div class="row g-4">

      <!-- Objectives -->
      <div class="col-md-4">
        <a href="?page=objectives" class="text-decoration-none text-dark">
          <div class="card p-4 text-center dashboard-card">
            <div class="icon-circle bg-primary"><i class="bi bi-person-lines-fill"></i></div>
            <h5 class="fw-bold">Objectives</h5>
            <p class="text-muted">Add or update objectives section</p>
          </div>
        </a>
      </div>

      <!-- Career -->
      <div class="col-md-4">
        <a href="?page=career-summary" class="text-decoration-none text-dark">
          <div class="card p-4 text-center dashboard-card">
            <div class="icon-circle bg-success"><i class="bi bi-bar-chart-fill"></i></div>
            <h5 class="fw-bold">Career</h5>
            <p class="text-muted">Manage your career</p>
          </div>
        </a>
      </div>

      <!-- Season Stats -->
      <div class="col-md-4">
        <a href="?page=season-stats" class="text-decoration-none text-dark">
          <div class="card p-4 text-center dashboard-card">
            <div class="icon-circle bg-warning"><i class="bi bi-lightbulb-fill"></i></div>
            <h5 class="fw-bold">Season Stats</h5>
            <p class="text-muted">Manage season</p>
          </div>
        </a>
      </div>

      <!-- H2H -->
      <div class="col-md-4">
        <a href="?page=head-to-head" class="text-decoration-none text-dark">
          <div class="card p-4 text-center dashboard-card">
            <div class="icon-circle bg-danger"><i class="bi bi-file-earmark-text-fill"></i></div>
            <h5 class="fw-bold">H2H</h5>
            <p class="text-muted">Team Stats</p>
          </div>
        </a>
      </div>

      <!-- Tournaments -->
      <div class="col-md-4">
        <a href="?page=tournaments" class="text-decoration-none text-dark">
          <div class="card p-4 text-center dashboard-card">
            <div class="icon-circle bg-danger"><i class="bi bi-file-earmark-text-fill"></i></div>
            <h5 class="fw-bold">Tournaments</h5>
            <p class="text-muted">Pre-Season, League, Cup</p>
          </div>
        </a>
      </div>

      <!-- Teams -->
      <div class="col-md-4">
        <a href="?page=teams" class="text-decoration-none text-dark">
          <div class="card p-4 text-center dashboard-card">
            <div class="icon-circle bg-danger"><i class="bi bi-file-earmark-text-fill"></i></div>
            <h5 class="fw-bold">Teams</h5>
            <p class="text-muted">League</p>
          </div>
        </a>
      </div>

    </div>
  </div>
</body>
</html>
