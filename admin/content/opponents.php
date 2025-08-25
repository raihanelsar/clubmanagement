<?php
include 'koneksi.php';
$msg = "";

// ==================== CREATE ====================
if (isset($_POST['add'])) {
    $team_id = intval($_POST['team_id']);
    $tournament_id = intval($_POST['tournament_id']);
    $season = intval($_POST['season']);
    $tournament = mysqli_real_escape_string($koneksi, $_POST['tournament']);

    $sql = "INSERT INTO opponents (team_id, tournament_id, season, tournament) 
            VALUES ($team_id, $tournament_id, $season, '$tournament')";
    if (mysqli_query($koneksi, $sql)) {
        $msg = "✅ Opponent added!";
    } else {
        $msg = "❌ Error: " . mysqli_error($koneksi);
    }
}

// ==================== UPDATE ====================
if (isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $team_id = intval($_POST['team_id']);
    $tournament_id = intval($_POST['tournament_id']);
    $season = intval($_POST['season']);
    $tournament = mysqli_real_escape_string($koneksi, $_POST['tournament']);

    $sql = "UPDATE opponents SET 
                team_id=$team_id, 
                tournament_id=$tournament_id, 
                season=$season, 
                tournament='$tournament' 
            WHERE id=$id";
    if (mysqli_query($koneksi, $sql)) {
        $msg = "✅ Opponent updated!";
    } else {
        $msg = "❌ Error: " . mysqli_error($koneksi);
    }
}

// ==================== DELETE ====================
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    if (mysqli_query($koneksi, "DELETE FROM opponents WHERE id=$id")) {
        $msg = "🗑️ Opponent deleted!";
    } else {
        $msg = "❌ Error: " . mysqli_error($koneksi);
    }
}

// ==================== GET DATA ====================
$result = mysqli_query($koneksi, "SELECT * FROM opponents ORDER BY id ASC");

// cek apakah sedang edit
$editData = null;
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $editRes = mysqli_query($koneksi, "SELECT * FROM opponents WHERE id=$id");
    $editData = mysqli_fetch_assoc($editRes);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Opponents</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f0f0f0; }
    h1 { text-align: center; background: #004080; padding: 15px; color: #fff; margin: 0; }
    table { width: 100%; border-collapse: collapse; margin: 20px 0; }
    th, td { border: 1px solid #000; padding: 8px; text-align: center; }
    th { background: #333; color: #fff; }
    td { background: #eaf4ff; }
    .btn { padding: 6px 12px; border-radius: 4px; text-decoration: none; color: #fff; }
    .edit { background: #007bff; }
    .delete { background: #d9534f; }
    .delete:hover { background: #c9302c; }
    form { max-width: 500px; margin: 20px auto; background: #fff; padding: 20px; border-radius: 8px; }
    input, textarea, select { width: 100%; padding: 8px; margin: 8px 0; }
    button { padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; }
    .save { background: green; color: #fff; }
    .update { background: #007bff; color: #fff; }
    .msg { text-align: center; margin: 10px; font-weight: bold; }
  </style>
</head>
<body>

<h1>Opponents</h1>
<div class="msg"><?= $msg; ?></div>

<!-- FORM ADD / EDIT -->
<form method="POST">
  <?php if ($editData): ?>
    <input type="hidden" name="id" value="<?= $editData['id']; ?>">
  <?php endif; ?>

  <label>Team ID</label>
  <input type="number" name="team_id" value="<?= $editData['team_id'] ?? ''; ?>" required>

  <label>Tournament ID</label>
  <input type="number" name="tournament_id" value="<?= $editData['tournament_id'] ?? ''; ?>" required>

  <label>Season (Year)</label>
  <input type="number" name="season" value="<?= $editData['season'] ?? ''; ?>" required>

  <label>Tournament (Name)</label>
  <input type="text" name="tournament" value="<?= $editData['tournament'] ?? ''; ?>">

  <?php if ($editData): ?>
    <button type="submit" name="update" class="update">Update</button>
    <a href="opponents.php" class="btn delete">Cancel</a>
  <?php else: ?>
    <button type="submit" name="add" class="save">Save</button>
  <?php endif; ?>
</form>

<!-- TABEL OPPONENTS -->
<table>
  <thead>
    <tr>
      <th>No</th>
      <th>Team ID</th>
      <th>Tournament ID</th>
      <th>Season</th>
      <th>Tournament</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php $no=1; while($row = mysqli_fetch_assoc($result)): ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= htmlspecialchars($row['team_id']); ?></td>
        <td><?= htmlspecialchars($row['tournament_id']); ?></td>
        <td><?= htmlspecialchars($row['season']); ?></td>
        <td><?= htmlspecialchars($row['tournament']); ?></td>
        <td>
          <a href="?page=opponents&edit=<?= $row['id']; ?>" class="btn edit">Edit</a>
          <a href="?page=opponents&delete=<?= $row['id']; ?>" class="btn delete" onclick="return confirm('Delete this opponent?')">Delete</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>

</body>
</html>
