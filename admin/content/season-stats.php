<?php
include 'koneksi.php';
$msg = "";

// ===== ADD DATA =====
if (isset($_POST['add'])) {
    $season       = mysqli_real_escape_string($koneksi, $_POST['season']);
    $matches      = (int)$_POST['matches'];
    $wins         = (int)$_POST['wins'];
    $draws        = (int)$_POST['draws'];
    $losses       = (int)$_POST['losses'];
    $goals_for    = (int)$_POST['goals_for'];
    $goals_against= (int)$_POST['goals_against'];

    mysqli_query($koneksi, "INSERT INTO season_stats 
        (season, matches, wins, draws, losses, goals_for, goals_against)
        VALUES ('$season','$matches','$wins','$draws','$losses','$goals_for','$goals_against')");
    $msg = "New season added!";
}

// ===== DELETE DATA =====
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    mysqli_query($koneksi, "DELETE FROM season_stats WHERE id=$id");
    $msg = "Data deleted!";
}

// ===== EDIT DATA =====
if (isset($_POST['update'])) {
    $id           = (int)$_POST['id'];
    $season       = mysqli_real_escape_string($koneksi, $_POST['season']);
    $matches      = (int)$_POST['matches'];
    $wins         = (int)$_POST['wins'];
    $draws        = (int)$_POST['draws'];
    $losses       = (int)$_POST['losses'];
    $goals_for    = (int)$_POST['goals_for'];
    $goals_against= (int)$_POST['goals_against'];

    mysqli_query($koneksi, "UPDATE season_stats SET 
        season='$season', matches='$matches', wins='$wins', draws='$draws', 
        losses='$losses', goals_for='$goals_for', goals_against='$goals_against'
        WHERE id=$id");
    $msg = "Data updated!";
}

// ===== GET DATA =====
$rows = mysqli_query($koneksi, "SELECT * FROM season_stats ORDER BY season ASC");

// ===== TOTAL & AVERAGE =====
$total = ["matches"=>0,"wins"=>0,"draws"=>0,"losses"=>0,"goals_for"=>0,"goals_against"=>0];
$seasons = [];
while ($r = mysqli_fetch_assoc($rows)) {
    $seasons[] = $r;
    $total["matches"] += $r["matches"];
    $total["wins"]    += $r["wins"];
    $total["draws"]   += $r["draws"];
    $total["losses"]  += $r["losses"];
    $total["goals_for"] += $r["goals_for"];
    $total["goals_against"] += $r["goals_against"];
}
$seasonCount = count($seasons);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Season Statistics</title>
    <style>
    body { background:#f2f2f2; color:#000; font-family:Arial; }
    h1 { background:brown; color:white; padding:10px; text-align:center; }
    table { border-collapse:collapse; width:100%; margin-top:20px; }
    th, td { border:1px solid #999; padding:6px; text-align:center; }
    th { background:#ddd; }
    tr:nth-child(even) { background:#eee; }
    tr:nth-child(odd) { background:#fff; }
    .msg { background:#d4edda; color:#155724; padding:8px; margin:10px 0; border:1px solid #c3e6cb; }
    form { margin:20px 0; background:#e9e9e9; padding:10px; border:1px solid #ccc; }
    input[type=text], input[type=number] { padding:5px; margin:5px; width:120px; border:1px solid #ccc; border-radius:4px; }
    button { padding:6px 12px; margin:5px; border:none; border-radius:4px; background:#555; color:white; cursor:pointer; }
    button:hover { background:#333; }
    a { color:red; text-decoration:none; }
</style>

</head>
<body>
<h1>Season statistics</h1>

<?php if ($msg): ?><div class="msg"><?= $msg ?></div><?php endif; ?>

<!-- ADD FORM -->
<h2>Add New Season</h2>
<form method="post">
    <input type="text" name="season" placeholder="Season (2024-25)" required>
    <input type="number" name="matches" placeholder="Matches">
    <input type="number" name="wins" placeholder="Wins">
    <input type="number" name="draws" placeholder="Draws">
    <input type="number" name="losses" placeholder="Losses">
    <input type="number" name="goals_for" placeholder="Goals For">
    <input type="number" name="goals_against" placeholder="Goals Against">
    <button type="submit" name="add">Add</button>
</form>

<!-- SEASON TABLE -->
<table>
<tr>
    <th>Season</th><th>Matches</th><th>Wins</th><th>Win %</th>
    <th>Draws</th><th>Draw %</th><th>Losses</th><th>Loss %</th>
    <th>Goals For</th><th>Per Game</th><th>Goals Against</th><th>Per Game</th>
    <th>Goal Difference</th><th>Actions</th>
</tr>
<?php foreach ($seasons as $s): 
    $winPct  = $s["matches"]>0 ? round(($s["wins"]/$s["matches"])*100,2):0;
    $drawPct = $s["matches"]>0 ? round(($s["draws"]/$s["matches"])*100,2):0;
    $lossPct = $s["matches"]>0 ? round(($s["losses"]/$s["matches"])*100,2):0;
    $gfpg    = $s["matches"]>0 ? round($s["goals_for"]/$s["matches"],2):0;
    $gapg    = $s["matches"]>0 ? round($s["goals_against"]/$s["matches"],2):0;
    $gd      = $s["goals_for"] - $s["goals_against"];
?>
<tr>
    <form method="post">
        <td><input type="text" name="season" value="<?= $s['season'] ?>"></td>
        <td><input type="number" name="matches" value="<?= $s['matches'] ?>"></td>
        <td><input type="number" name="wins" value="<?= $s['wins'] ?>"></td>
        <td><?= $winPct ?>%</td>
        <td><input type="number" name="draws" value="<?= $s['draws'] ?>"></td>
        <td><?= $drawPct ?>%</td>
        <td><input type="number" name="losses" value="<?= $s['losses'] ?>"></td>
        <td><?= $lossPct ?>%</td>
        <td><input type="number" name="goals_for" value="<?= $s['goals_for'] ?>"></td>
        <td><?= $gfpg ?></td>
        <td><input type="number" name="goals_against" value="<?= $s['goals_against'] ?>"></td>
        <td><?= $gapg ?></td>
        <td><?= $gd ?></td>
        <td>
            <input type="hidden" name="id" value="<?= $s['id'] ?>">
            <button type="submit" name="update">Update</button>
            <a href="?delete=<?= $s['id'] ?>" onclick="return confirm('Delete this season?')">Delete</a>
        </td>
    </form>
</tr>
<?php endforeach; ?>

<!-- TOTAL -->
<tr style="font-weight:bold;background:#444;">
    <td>Total</td>
    <td><?= $total["matches"] ?></td>
    <td><?= $total["wins"] ?></td><td>-</td>
    <td><?= $total["draws"] ?></td><td>-</td>
    <td><?= $total["losses"] ?></td><td>-</td>
    <td><?= $total["goals_for"] ?></td><td>-</td>
    <td><?= $total["goals_against"] ?></td><td>-</td>
    <td><?= $total["goals_for"]-$total["goals_against"] ?></td><td>-</td>
</tr>
<tr style="font-weight:bold;background:#555;">
    <td>Average</td>
    <td><?= $seasonCount>0?round($total["matches"]/$seasonCount,2):0 ?></td>
    <td><?= $seasonCount>0?round($total["wins"]/$seasonCount,2):0 ?></td><td>-</td>
    <td><?= $seasonCount>0?round($total["draws"]/$seasonCount,2):0 ?></td><td>-</td>
    <td><?= $seasonCount>0?round($total["losses"]/$seasonCount,2):0 ?></td><td>-</td>
    <td><?= $seasonCount>0?round($total["goals_for"]/$seasonCount,2):0 ?></td><td>-</td>
    <td><?= $seasonCount>0?round($total["goals_against"]/$seasonCount,2):0 ?></td><td>-</td>
    <td><?= $seasonCount>0?round(($total["goals_for"]-$total["goals_against"])/$seasonCount,2):0 ?></td><td>-</td>
</tr>
</table>
</body>
</html>
