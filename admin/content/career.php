<?php
include 'koneksi.php';

$msg       = '';
$editMode  = false;
$editData  = null;

// =====================
// DELETE
// =====================
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($koneksi, "DELETE FROM career WHERE id=$id");
    header("Location: career.php");
    exit;
}

// =====================
// EDIT (ambil data berdasarkan ID)
// =====================
if (isset($_GET['edit'])) {
    $editMode = true;
    $id       = intval($_GET['edit']);
    $editData = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM career WHERE id=$id"));
}

// =====================
// SAVE (ADD / UPDATE)
// =====================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $season    = mysqli_real_escape_string($koneksi, $_POST['season']);
    $league    = mysqli_real_escape_string($koneksi, $_POST['league']);
    $cup       = mysqli_real_escape_string($koneksi, $_POST['cup']);
    $champions = mysqli_real_escape_string($koneksi, $_POST['champions']);
    $europa    = mysqli_real_escape_string($koneksi, $_POST['europa']);
    $supercup  = mysqli_real_escape_string($koneksi, $_POST['supercup']);
    $european  = mysqli_real_escape_string($koneksi, $_POST['european']);

    if (!empty($_POST['id'])) {
        // UPDATE
        $id = intval($_POST['id']);
        mysqli_query($koneksi, "
            UPDATE career SET 
                season    = '$season',
                league    = '$league',
                cup       = '$cup',
                champions = '$champions',
                europa    = '$europa',
                supercup  = '$supercup',
                european  = '$european'
            WHERE id = $id
        ");
        $msg = "Data berhasil diperbarui!";
    } else {
        // INSERT
        mysqli_query($koneksi, "
            INSERT INTO career (season, league, cup, champions, europa, supercup, european)
            VALUES ('$season','$league','$cup','$champions','$europa','$supercup','$european')
        ");
        $msg = "Data berhasil ditambahkan!";
    }
    header("Location: career.php");
    exit;
}

// =====================
// AMBIL SEMUA DATA
// =====================
$result = mysqli_query($koneksi, "SELECT * FROM career ORDER BY season ASC");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Career Summary</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container my-5">
  <h2 class="text-center mb-4">Career Summary</h2>

  <!-- FORM ADD / EDIT -->
  <div class="card mb-4 shadow-sm">
    <div class="card-header bg-primary text-white">
      <?= $editMode ? "Edit Career Record" : "Add Career Record"; ?>
    </div>
    <div class="card-body">
      <form method="post">
        <?php if ($editMode): ?>
          <input type="hidden" name="id" value="<?= $editData['id']; ?>">
        <?php endif; ?>
        
        <div class="row">
          <div class="col-md-3 mb-3">
            <label class="form-label">Season</label>
            <input type="text" name="season" class="form-control" required 
                   value="<?= $editMode ? $editData['season'] : ''; ?>">
          </div>
          <div class="col-md-3 mb-3">
            <label class="form-label">League</label>
            <input type="text" name="league" class="form-control" 
                   value="<?= $editMode ? $editData['league'] : ''; ?>">
          </div>
          <div class="col-md-3 mb-3">
            <label class="form-label">Cup</label>
            <input type="text" name="cup" class="form-control" 
                   value="<?= $editMode ? $editData['cup'] : ''; ?>">
          </div>
          <div class="col-md-3 mb-3">
            <label class="form-label">Champions</label>
            <input type="text" name="champions" class="form-control" 
                   value="<?= $editMode ? $editData['champions'] : ''; ?>">
          </div>
          <div class="col-md-3 mb-3">
            <label class="form-label">Europa</label>
            <input type="text" name="europa" class="form-control" 
                   value="<?= $editMode ? $editData['europa'] : ''; ?>">
          </div>
          <div class="col-md-3 mb-3">
            <label class="form-label">Supercup</label>
            <input type="text" name="supercup" class="form-control" 
                   value="<?= $editMode ? $editData['supercup'] : ''; ?>">
          </div>
          <div class="col-md-3 mb-3">
            <label class="form-label">European</label>
            <input type="text" name="european" class="form-control" 
                   value="<?= $editMode ? $editData['european'] : ''; ?>">
          </div>
        </div>

        <button type="submit" class="btn btn-success">
          <?= $editMode ? "Update" : "Add"; ?>
        </button>
        <?php if ($editMode): ?>
          <a href="career.php" class="btn btn-secondary">Cancel</a>
        <?php endif; ?>
      </form>
    </div>
  </div>

  <!-- TABEL DATA -->
  <div class="card shadow-sm">
    <div class="card-header bg-dark text-white">
      Daftar Career
    </div>
    <div class="card-body p-0">
      <table class="table table-bordered table-striped text-center align-middle mb-0">
        <thead class="table-dark">
          <tr>
            <th>Season</th>
            <th>League</th>
            <th>Cup</th>
            <th>Champions</th>
            <th>Europa</th>
            <th>Supercup</th>
            <th>European</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
              <td><?= htmlspecialchars($row['season']); ?></td>
              <td><?= htmlspecialchars($row['league']); ?></td>
              <td><?= htmlspecialchars($row['cup']); ?></td>
              <td><?= htmlspecialchars($row['champions']); ?></td>
              <td><?= htmlspecialchars($row['europa']); ?></td>
              <td><?= htmlspecialchars($row['supercup']); ?></td>
              <td><?= htmlspecialchars($row['european']); ?></td>
              <td>
                <a href="career.php?edit=<?= $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="career.php?delete=<?= $row['id']; ?>" 
                   class="btn btn-sm btn-danger"
                   onclick="return confirm('Yakin mau hapus data ini?')">Delete</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>

</div>

</body>
</html>
