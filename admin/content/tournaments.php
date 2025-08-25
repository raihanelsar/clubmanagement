<?php
include 'koneksi.php';
$msg = "";

// CREATE
if (isset($_POST['add'])) {
    $name    = mysqli_real_escape_string($koneksi, trim($_POST['name']));
    $type    = mysqli_real_escape_string($koneksi, trim($_POST['type']));
    $country = mysqli_real_escape_string($koneksi, trim($_POST['country']));
    $season  = intval($_POST['season']);
    $format  = mysqli_real_escape_string($koneksi, trim($_POST['format']));

    if ($name && $type) {
        $sql = "INSERT INTO tournaments (name,type,country,season,format) 
                VALUES ('$name','$type','$country',$season,'$format')";
        $msg = mysqli_query($koneksi, $sql) ? "✅ Tournament added!" : "❌ Error: " . mysqli_error($koneksi);
    } else {
        $msg = "⚠️ Name and Type are required!";
    }
}

// UPDATE
if (isset($_POST['update'])) {
    $id      = intval($_POST['id']);
    $name    = mysqli_real_escape_string($koneksi, trim($_POST['name']));
    $type    = mysqli_real_escape_string($koneksi, trim($_POST['type']));
    $country = mysqli_real_escape_string($koneksi, trim($_POST['country']));
    $season  = intval($_POST['season']);
    $format  = mysqli_real_escape_string($koneksi, trim($_POST['format']));

    if ($id && $name && $type) {
        $sql = "UPDATE tournaments SET 
                    name='$name', 
                    type='$type', 
                    country='$country',
                    season=$season, 
                    format='$format'
                WHERE id=$id";
        $msg = mysqli_query($koneksi, $sql) ? "✅ Tournament updated!" : "❌ Error: " . mysqli_error($koneksi);
    } else {
        $msg = "⚠️ Invalid data!";
    }
}

// DELETE
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    if ($id > 0) {
        $msg = mysqli_query($koneksi, "DELETE FROM tournaments WHERE id=$id") 
            ? "🗑️ Tournament deleted!" 
            : "❌ Error: " . mysqli_error($koneksi);
    }
}

// DATA
$result = mysqli_query($koneksi, "SELECT * FROM tournaments ORDER BY id ASC");

// EDIT MODE
$editData = null;
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $editRes = mysqli_query($koneksi, "SELECT * FROM tournaments WHERE id=$id");
    $editData = mysqli_fetch_assoc($editRes);
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Tournaments Management</title>
  <style>
    body { font-family: Arial, sans-serif; background:#f4f6f9; margin:0; padding:20px; }
    h1 { background:#0056b3; color:#fff; padding:12px; margin:0; }
    .msg { text-align:center; margin:15px 0; font-weight:bold; }
    table { width:100%; border-collapse:collapse; margin:20px 0; background:#fff; box-shadow:0 2px 6px rgba(0,0,0,0.1); }
    th, td { border:1px solid #ddd; padding:10px; text-align:center; }
    th { background:#333; color:#fff; }
    tr:nth-child(even) td { background:#f9f9f9; }
    form { max-width:500px; margin:20px auto; background:#fff; padding:20px; border-radius:8px; box-shadow:0 2px 6px rgba(0,0,0,0.1); }
    input, select { width:100%; padding:8px; margin:8px 0; border:1px solid #ccc; border-radius:4px; }
    button { padding:8px 15px; margin:5px 0; cursor:pointer; border:none; border-radius:4px; }
    .btn-add { background:#28a745; color:#fff; }
    .btn-update { background:#007bff; color:#fff; }
    .btn-edit, .btn-delete { padding:6px 10px; border-radius:4px; text-decoration:none; }
    .btn-edit { background:#17a2b8; color:#fff; }
    .btn-delete { background:#d9534f; color:#fff; }
    a.cancel { display:inline-block; margin-top:10px; color:#555; }
  </style>
</head>
<body>
<h1>Tournaments Management</h1>

<div class="msg"><?= $msg ?></div>

<form method="POST">
  <?php if ($editData): ?>
    <input type="hidden" name="id" value="<?= $editData['id'] ?>">
  <?php endif; ?>

  <input type="text" name="name" placeholder="Tournament Name" value="<?= htmlspecialchars($editData['name'] ?? '') ?>" required>

  <select name="type" required>
    <option value="">-- Select Type --</option>
    <option value="League" <?= ($editData['type'] ?? '')=='League'?'selected':'' ?>>League</option>
    <option value="Cup" <?= ($editData['type'] ?? '')=='Cup'?'selected':'' ?>>Cup</option>
  </select>

  <input type="text" name="country" placeholder="Country" value="<?= htmlspecialchars($editData['country'] ?? '') ?>">

  <input type="number" name="season" placeholder="Season (Year)" value="<?= htmlspecialchars($editData['season'] ?? '') ?>">

  <input type="text" name="format" placeholder="Format (Group Stage / Knockout)" value="<?= htmlspecialchars($editData['format'] ?? '') ?>">

  <?php if ($editData): ?>
    <button type="submit" name="update" class="btn-update">Update</button>
    <a href="tournaments.php" class="cancel">Cancel</a>
  <?php else: ?>
    <button type="submit" name="add" class="btn-add">Add</button>
  <?php endif; ?>
</form>

<table>
<tr>
  <th>ID</th>
  <th>Name</th>
  <th>Type</th>
  <th>Country</th>
  <th>Season</th>
  <th>Format</th>
  <th>Actions</th>
</tr>
<?php while ($row=mysqli_fetch_assoc($result)): ?>
<tr>
  <td><?= $row['id'] ?></td>
  <td><?= htmlspecialchars($row['name']) ?></td>
  <td><?= htmlspecialchars($row['type']) ?></td>
  <td><?= htmlspecialchars($row['country']) ?></td>
  <td><?= htmlspecialchars($row['season']) ?></td>
  <td><?= htmlspecialchars($row['format']) ?></td>
  <td>
    <a href="?edit=<?= $row['id'] ?>" class="btn-edit">Edit</a>
    <a href="?delete=<?= $row['id'] ?>" class="btn-delete" onclick="return confirm('Delete this tournament?')">Delete</a>
  </td>
</tr>
<?php endwhile; ?>
</table>
</body>
</html>
