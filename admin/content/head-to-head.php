<?php
include 'koneksi.php';
$msg = "";

// ===== ADD DATA =====
if (isset($_POST['add'])) {
    $season   = trim($_POST['season']);
    $opponent = trim($_POST['opponent']);

    $stmt = $koneksi->prepare("INSERT INTO head_to_head (season, opponent) VALUES (?, ?)");
    $stmt->bind_param("ss", $season, $opponent);
    if ($stmt->execute()) {
        $msg = "✅ New opponent added!";
    } else {
        $msg = "❌ Error: " . $stmt->error;
    }
    $stmt->close();
}

// ===== DELETE =====
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];

    $stmt = $koneksi->prepare("DELETE FROM head_to_head WHERE id=?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $msg = "✅ Opponent deleted!";
    } else {
        $msg = "❌ Error: " . $stmt->error;
    }
    $stmt->close();
}

// ===== UPDATE =====
if (isset($_POST['update'])) {
    $id       = (int)$_POST['id'];
    $season   = trim($_POST['season']);
    $opponent = trim($_POST['opponent']);

    $fields = [
        "home_wins","home_draws","home_losses","home_scored","home_conceded",
        "away_wins","away_draws","away_losses","away_scored","away_conceded",
        "neutral_wins","neutral_draws","neutral_losses","neutral_scored","neutral_conceded"
    ];

    $sql = "UPDATE head_to_head SET season=?, opponent=?";
    foreach ($fields as $f) {
        $sql .= ", $f=?";
    }
    $sql .= " WHERE id=?";

    $stmt = $koneksi->prepare($sql);

    // Ambil semua value
    $values = [];
    foreach ($fields as $f) {
        $values[] = (int)($_POST[$f] ?? 0);
    }

    // Binding parameter
    $types = "ss" . str_repeat("i", count($fields)) . "i"; // 2 string + 14 int + id
    $params = array_merge([$types, $season, $opponent], $values, [$id]);

    $stmt->bind_param(...$params);

    if ($stmt->execute()) {
        $msg = "✅ Opponent updated!";
    } else {
        $msg = "❌ Error: " . $stmt->error;
    }
    $stmt->close();
}

// ===== FETCH =====
$result = $koneksi->query("SELECT * FROM head_to_head ORDER BY opponent ASC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Head to Head</title>
    <style>
        body { background:#f2f2f2; color:#000; font-family:Arial; }
        h1 { background:brown; color:white; padding:10px; text-align:center; }
        table { border-collapse:collapse; width:100%; margin-top:20px; font-size:14px; }
        th, td { border:1px solid #999; padding:6px; text-align:center; }
        th { background:#ddd; }
        tr:nth-child(even) { background:#eee; }
        .msg { background:#d4edda; color:#155724; padding:8px; margin:10px 0; border:1px solid #c3e6cb; }
        form { margin:10px 0; }
        input[type=text], input[type=number] { padding:4px; text-align:center; }
        input[type=text] { width:140px; }
        input[type=number] { width:60px; }
        button { padding:4px 10px; margin:2px; cursor:pointer; }
        a.delete { color:red; text-decoration:none; }
    </style>
</head>
<body>
<h1>Head to Head</h1>
<?php if ($msg): ?><div class="msg"><?= $msg ?></div><?php endif; ?>

<!-- ADD NEW OPPONENT -->
<h2>Add Opponent</h2>
<form method="post">
    <input type="text" name="season" placeholder="Season (2024-25)" required>
    <input type="text" name="opponent" placeholder="Opponent" required>
    <button type="submit" name="add">Add</button>
</form>

<!-- TABLE -->
<table>
<tr>
    <th rowspan="2">Season</th>
    <th rowspan="2">Opponent</th>
    <th colspan="5">Home</th>
    <th colspan="5">Away</th>
    <th colspan="5">Neutral</th>
    <th rowspan="2">Actions</th>
</tr>
<tr>
    <th>Wins</th><th>Draws</th><th>Losses</th><th>Scored</th><th>Conceded</th>
    <th>Wins</th><th>Draws</th><th>Losses</th><th>Scored</th><th>Conceded</th>
    <th>Wins</th><th>Draws</th><th>Losses</th><th>Scored</th><th>Conceded</th>
</tr>
<?php while ($row = $result->fetch_assoc()): ?>
<tr>
    <form method="post">
        <td>
            <input type="text" name="season" value="<?= htmlspecialchars($row['season']) ?>">
        </td>
        <td>
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <input type="text" name="opponent" value="<?= htmlspecialchars($row['opponent']) ?>">
        </td>

        <!-- Home -->
        <td><input type="number" name="home_wins" value="<?= $row['home_wins'] ?>"></td>
        <td><input type="number" name="home_draws" value="<?= $row['home_draws'] ?>"></td>
        <td><input type="number" name="home_losses" value="<?= $row['home_losses'] ?>"></td>
        <td><input type="number" name="home_scored" value="<?= $row['home_scored'] ?>"></td>
        <td><input type="number" name="home_conceded" value="<?= $row['home_conceded'] ?>"></td>

        <!-- Away -->
        <td><input type="number" name="away_wins" value="<?= $row['away_wins'] ?>"></td>
        <td><input type="number" name="away_draws" value="<?= $row['away_draws'] ?>"></td>
        <td><input type="number" name="away_losses" value="<?= $row['away_losses'] ?>"></td>
        <td><input type="number" name="away_scored" value="<?= $row['away_scored'] ?>"></td>
        <td><input type="number" name="away_conceded" value="<?= $row['away_conceded'] ?>"></td>

        <!-- Neutral -->
        <td><input type="number" name="neutral_wins" value="<?= $row['neutral_wins'] ?>"></td>
        <td><input type="number" name="neutral_draws" value="<?= $row['neutral_draws'] ?>"></td>
        <td><input type="number" name="neutral_losses" value="<?= $row['neutral_losses'] ?>"></td>
        <td><input type="number" name="neutral_scored" value="<?= $row['neutral_scored'] ?>"></td>
        <td><input type="number" name="neutral_conceded" value="<?= $row['neutral_conceded'] ?>"></td>

        <td>
            <button type="submit" name="update">Update</button>
            <a class="delete" href="?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this opponent?')">Delete</a>
        </td>
    </form>
</tr>
<?php endwhile; ?>
</table>
</body>
</html>
