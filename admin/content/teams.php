<?php
include 'koneksi.php';
$msg = "";

// CREATE
if (isset($_POST['add'])) {
    $name = mysqli_real_escape_string($koneksi, $_POST['name']);
    $country = mysqli_real_escape_string($koneksi, $_POST['country']);
    $founded = intval($_POST['founded']);
    $stadium = mysqli_real_escape_string($koneksi, $_POST['stadium']);

    $sql = "INSERT INTO teams (name, country, founded, stadium) 
            VALUES ('$name','$country',$founded,'$stadium')";
    $msg = mysqli_query($koneksi, $sql) ? "✅ Team added!" : "❌ Error: " . mysqli_error($koneksi);
}

// UPDATE
if (isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $name = mysqli_real_escape_string($koneksi, $_POST['name']);
    $country = mysqli_real_escape_string($koneksi, $_POST['country']);
    $founded = intval($_POST['founded']);
    $stadium = mysqli_real_escape_string($koneksi, $_POST['stadium']);

    $sql = "UPDATE teams SET 
                name='$name',
                country='$country',
                founded=$founded,
                stadium='$stadium'
            WHERE id=$id";
    $msg = mysqli_query($koneksi, $sql) ? "✅ Team updated!" : "❌ Error: " . mysqli_error($koneksi);
}

// DELETE
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $msg = mysqli_query($koneksi, "DELETE FROM teams WHERE id=$id") 
        ? "🗑️ Team deleted!" 
        : "❌ Error: " . mysqli_error($koneksi);
}

// DATA
$result = mysqli_query($koneksi, "SELECT * FROM teams ORDER BY id ASC");

// EDIT MODE
$editData = null;
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $editRes = mysqli_query($koneksi, "SELECT * FROM teams WHERE id=$id");
    $editData = mysqli_fetch_assoc($editRes);
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Teams Management</title>
  <style>
    body { font-family: Arial; background: #f4f4f4; }
    h1 { background:#222; color:#fff; padding:10px; }
    table { width:100%; border-collapse:collapse; margin:20px 0; }
    th, td { border:1px solid #000; padding:8px; text-align:center; }
    th { background:#333; color:#fff; }
    td { background:#fff; }
    form { max-width:500px; margin:20px auto; background:#fff; padding:20px; border-radius:8px; }
    input { width:100%; padding:8px; margin:8px 0; }
    button { padding:8px 15px; margin:5px; cursor:pointer; }
    .btn-edit { background:#007bff; color:#fff; text-decoration:none; padding:5px 10px; }
    .btn-delete { background:#d9534f; color:#fff; text-decoration:none; padding:5px 10px; }
  </style>
</head>
<body>
<h1>Teams Management</h1>
<div style="text-align:center;"><?= $msg ?></div>

<form method="POST">
  <?php if ($editData): ?><input type="hidden" name="id" value="<?= $editData['id'] ?>"><?php endif; ?>
  <input type="text" name="name" placeholder="Team Name" value="<?= $editData['name'] ?? '' ?>" required>
  <input type="text" name="country" placeholder="Country" value="<?= $editData['country'] ?? '' ?>">
  <input type="number" name="founded" placeholder="Founded Year" value="<?= $editData['founded'] ?? '' ?>">
  <input type="text" name="stadium" placeholder="Stadium" value="<?= $editData['stadium'] ?? '' ?>">
  <?php if ($editData): ?>
    <button type="submit" name="update">Update</button>
    <a href="teams.php">Cancel</a>
  <?php else: ?>
    <button type="submit" name="add">Add</button>
  <?php endif; ?>
</form>

<table>
<tr>
  <th>ID</th><th>Name</th><th>Country</th><th>Founded</th><th>Stadium</th><th>Actions</th>
</tr>
<?php while ($row=mysqli_fetch_assoc($result)): ?>
<tr>
  <td><?= $row['id'] ?></td>
  <td><?= htmlspecialchars($row['name']) ?></td>
  <td><?= htmlspecialchars($row['country']) ?></td>
  <td><?= htmlspecialchars($row['founded']) ?></td>
  <td><?= htmlspecialchars($row['stadium']) ?></td>
  <td>
    <a href="?edit=<?= $row['id'] ?>" class="btn-edit">Edit</a>
    <a href="?delete=<?= $row['id'] ?>" class="btn-delete" onclick="return confirm('Delete team?')">Delete</a>
  </td>
</tr>
<?php endwhile; ?>
</table>
</body>
</html>
