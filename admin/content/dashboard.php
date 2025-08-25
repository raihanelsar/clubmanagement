<?php include 'koneksi.php'; ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard</title>
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
    <h1 class="mb-5 text-center fw-bold">Admin Dashboard</h1>
    <div class="row g-4">

      <!-- About -->
      <div class="col-md-4">
        <a href="?page=office" class="text-decoration-none text-dark">
          <div class="card p-4 text-center dashboard-card">
            <div class="icon-circle bg-primary"><i class="bi bi-person-lines-fill"></i></div>
            <h5 class="fw-bold">Office</h5>
            <p class="text-muted">Objectives, Season, Fixture</p>
          </div>
        </a>
      </div>

      <!-- Squad -->
      <div class="col-md-4">
        <a href="?page=squad" class="text-decoration-none text-dark">
          <div class="card p-4 text-center dashboard-card">
            <div class="icon-circle bg-success"><i class="bi bi-bar-chart-fill"></i></div>
            <h5 class="fw-bold">Squad</h5>
            <p class="text-muted">Manage your squad</p>
          </div>
        </a>
      </div>

      <!-- Transfers -->
      <div class="col-md-4">
        <a href="?page=transfers" class="text-decoration-none text-dark">
          <div class="card p-4 text-center dashboard-card">
            <div class="icon-circle bg-warning"><i class="bi bi-lightbulb-fill"></i></div>
            <h5 class="fw-bold">Transfers</h5>
            <p class="text-muted">Buy, Sell, Loan, Scout</p>
          </div>
        </a>
      </div>

      
    </div>
  </div>
</body>
</html>
