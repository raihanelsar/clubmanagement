<?php
include 'koneksi.php';

$msg = "";

// ==================== CREATE ====================
if (isset($_POST['add'])) {
    $season          = mysqli_real_escape_string($koneksi, $_POST['season']);
    $league_objective = mysqli_real_escape_string($koneksi, $_POST['league_objective']);
    $other_objectives = mysqli_real_escape_string($koneksi, $_POST['other_objectives']);
    $status          = mysqli_real_escape_string($koneksi, $_POST['status']);

    $sql = "INSERT INTO objectives (season, league_objective, other_objectives, status) 
            VALUES ('$season', '$league_objective', '$other_objectives', '$status')";
    $msg = mysqli_query($koneksi, $sql) ? "✅ Objective added!" : "❌ Error: " . mysqli_error($koneksi);
}

// ==================== UPDATE ====================
if (isset($_POST['update'])) {
    $id              = intval($_POST['id']);
    $season          = mysqli_real_escape_string($koneksi, $_POST['season']);
    $league_objective = mysqli_real_escape_string($koneksi, $_POST['league_objective']);
    $other_objectives = mysqli_real_escape_string($koneksi, $_POST['other_objectives']);
    $status          = mysqli_real_escape_string($koneksi, $_POST['status']);

    $sql = "UPDATE objectives 
            SET season='$season', 
                league_objective='$league_objective', 
                other_objectives='$other_objectives', 
                status='$status' 
            WHERE id=$id";
    $msg = mysqli_query($koneksi, $sql) ? "✅ Objective updated!" : "❌ Error: " . mysqli_error($koneksi);
}

// ==================== DELETE ====================
if (isset($_GET['delete'])) {
    $id  = intval($_GET['delete']);
    $msg = mysqli_query($koneksi, "DELETE FROM objectives WHERE id=$id") 
        ? "🗑️ Objective deleted!" 
        : "❌ Error: " . mysqli_error($koneksi);
}

// ==================== GET DATA ====================
$result = mysqli_query($koneksi, "SELECT * FROM objectives ORDER BY id ASC");

// Cek apakah sedang edit
$editData = null;
if (isset($_GET['edit'])) {
    $id       = intval($_GET['edit']);
    $editRes  = mysqli_query($koneksi, "SELECT * FROM objectives WHERE id=$id");
    $editData = mysqli_fetch_assoc($editRes);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Objectives</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f0f0f0; margin:0; padding:0; }
    h1 { text-align: center; background: #7b0000; padding: 15px; color: #fff; margin: 0; }
    .msg { text-align: center; margin: 10px; font-weight: bold; }

    form { 
      max-width: 500px; margin: 20px auto; 
      background: #fff; padding: 20px; 
      border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    label { font-weight: bold; }
    input, textarea, select { width: 100%; padding: 8px; margin: 8px 0; }
    button, .btn { 
      padding: 8px 14px; border-radius: 4px; border: none; 
      cursor: pointer; text-decoration: none; font-size: 14px;
    }
    .save { background: green; color: #fff; }
    .update { background: #007bff; color: #fff; }
    .btn.edit { background: #007bff; color: #fff; }
    .btn.delete { background: #d9534f; color: #fff; }
    .btn.delete:hover { background: #c9302c; }

    table { width: 100%; border-collapse: collapse; margin: 20px 0; background: #fff; }
    th, td { border: 1px solid #000; padding: 8px; text-align: center; }
    th { background: #333; color: #fff; }
    td { background: #f9e8b2; }
  </style>
</head>
<body>

<h1>Objectives</h1>
<div class="msg"><?= $msg; ?></div>

<!-- FORM ADD / EDIT -->
<form method="POST">
  <?php if ($editData): ?>
    <input type="hidden" name="id" value="<?= $editData['id']; ?>">
  <?php endif; ?>

  <label>Season</label>
  <input type="text" name="season" value="<?= htmlspecialchars($editData['season'] ?? ''); ?>" required>

  <label>League Objective</label>
  <input type="text" name="league_objective" value="<?= htmlspecialchars($editData['league_objective'] ?? ''); ?>">

  <label>Other Objectives</label>
  <textarea name="other_objectives"><?= htmlspecialchars($editData['other_objectives'] ?? ''); ?></textarea>

  <label>Status</label>
  <select name="status">
    <option value="In Progress" <?= (isset($editData) && $editData['status']=="In Progress") ? "selected" : ""; ?>>In Progress</option>
    <option value="Completed" <?= (isset($editData) && $editData['status']=="Completed") ? "selected" : ""; ?>>Completed</option>
    <option value="Pending" <?= (isset($editData) && $editData['status']=="Pending") ? "selected" : ""; ?>>Pending</option>
  </select>

  <?php if ($editData): ?>
    <button type="submit" name="update" class="update">Update</button>
    <a href="objectives.php" class="btn delete">Cancel</a>
  <?php else: ?>
    <button type="submit" name="add" class="save">Save</button>
  <?php endif; ?>
</form>

<!-- TABEL OBJECTIVES -->
<table>
  <thead>
    <tr>
      <th>No</th>
      <th>Season</th>
      <th>League Objective</th>
      <th>Other Objectives</th>
      <th>Status</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php $no=1; while($row = mysqli_fetch_assoc($result)): ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= htmlspecialchars($row['season']); ?></td>
        <td><?= htmlspecialchars($row['league_objective']); ?></td>
        <td><?= htmlspecialchars($row['other_objectives']); ?></td>
        <td><?= htmlspecialchars($row['status']); ?></td>
        <td>
          <a href="?page=objectives&edit=<?= $row['id']; ?>" class="btn edit">Edit</a>
          <a href="?page=objectives&delete=<?= $row['id']; ?>" class="btn delete" onclick="return confirm('Delete this objective?')">Delete</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>

</body>
</html>
