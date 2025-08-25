<?php
// Koneksi database
include 'koneksi.php';

// Ambil daftar turnamen & lawan
$tournaments = mysqli_query($koneksi, "SELECT * FROM tournaments ORDER BY name ASC");
$opponents   = mysqli_query($koneksi, "SELECT * FROM opponents ORDER BY name ASC");

// CREATE - Tambah data baru
if (isset($_POST['add'])) {
    $month = $_POST['month'];
    $tournament_id = $_POST['tournament_id'];
    $ground = $_POST['ground'];
    $score = $_POST['score'];
    $opponent_id = $_POST['opponent_id'];
    $goal_scorers = $_POST['goal_scorers'];
    $assists = $_POST['assists'];
    $man_of_the_match = $_POST['man_of_the_match'];
    $player_of_the_month = $_POST['player_of_the_month'];

    mysqli_query($koneksi, "INSERT INTO fixtures 
        (month, tournament_id, ground, score, opponent_id, goal_scorers, assists, man_of_the_match, player_of_the_month) 
        VALUES 
        ('$month','$tournament_id','$ground','$score','$opponent_id','$goal_scorers','$assists','$man_of_the_match','$player_of_the_month')");
    header("Location: fixtures.php");
    exit();
}

// UPDATE - Edit data
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $month = $_POST['month'];
    $tournament_id = $_POST['tournament_id'];
    $ground = $_POST['ground'];
    $score = $_POST['score'];
    $opponent_id = $_POST['opponent_id'];
    $goal_scorers = $_POST['goal_scorers'];
    $assists = $_POST['assists'];
    $man_of_the_match = $_POST['man_of_the_match'];
    $player_of_the_month = $_POST['player_of_the_month'];

    mysqli_query($koneksi, "UPDATE fixtures SET 
        month='$month', tournament_id='$tournament_id', ground='$ground', score='$score', 
        opponent_id='$opponent_id', goal_scorers='$goal_scorers', assists='$assists', 
        man_of_the_match='$man_of_the_match', player_of_the_month='$player_of_the_month'
        WHERE id=$id");
    header("Location: fixtures.php");
    exit();
}

// DELETE - Hapus data
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($koneksi, "DELETE FROM fixtures WHERE id=$id");
    header("Location: fixtures.php");
    exit();
}

// Ambil semua data fixture dengan join tournament & opponent
$result = mysqli_query($koneksi, "SELECT fixtures.*, 
    tournaments.name AS tournament_name, 
    opponents.name AS opponent_name
    FROM fixtures 
    LEFT JOIN tournaments ON fixtures.tournament_id = tournaments.id 
    LEFT JOIN opponents ON fixtures.opponent_id = opponents.id 
    ORDER BY fixtures.id ASC
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fixtures Management</title>
  <style>
    body { font-family: Arial, sans-serif; background:#f2f2f2; margin:0; padding:0; }
    h1 { text-align:center; background:#b52b2b; color:white; padding:15px; margin:0; }
    .container { width:95%; max-width:1200px; margin:20px auto; background:#fff; padding:20px; border-radius:8px; }
    form { margin-bottom:20px; }
    input, select { padding:8px; margin:5px; border-radius:5px; border:1px solid #ccc; width:calc(100%/3 - 20px); box-sizing:border-box; }
    button { padding:10px 15px; background:#28a745; color:white; border:none; border-radius:5px; cursor:pointer; }
    button:hover { background:#218838; }
    table { width:100%; border-collapse:collapse; background:#fff; }
    th { background:#b52b2b; color:#fff; padding:10px; }
    td { padding:8px; border:1px solid #ddd; text-align:center; }
    tr:nth-child(even){ background:#f9f9f9; }
    .btn-delete { background:#dc3545; padding:6px 12px; color:#fff; border-radius:5px; text-decoration:none; }
    .btn-delete:hover { background:#c82333; }
  </style>
</head>
<body>
<h1>Fixtures Management</h1>
<div class="container">

  <!-- Form Tambah Data -->
  <h2>Add New Fixture</h2>
  <form method="POST">
    <input type="date" name="month" placeholder="Month (e.g. July 2024)" required>

    <!-- Dropdown Tournament -->
    <select name="tournament_id" required>
      <option value="">-- Select Tournament --</option>
      <?php while($t = mysqli_fetch_assoc($tournaments)) : ?>
        <option value="<?= $t['id'] ?>"><?= $t['name'] ?></option>
      <?php endwhile; ?>
    </select>

    <!-- Dropdown Ground -->
    <select name="ground" required>
        <option value="">-- Select Ground --</option>
        <option value="Home">Home</option>
        <option value="Away">Away</option>
        <option value="Neutral">Neutral</option>
    </select>
    <input type="text" name="score" placeholder="Score">

    <!-- Dropdown Opponent -->
    <select name="opponent_id" required>
      <option value="">-- Select Opponent --</option>
      <?php while($o = mysqli_fetch_assoc($opponents)) : ?>
        <option value="<?= $o['id'] ?>"><?= $o['name'] ?></option>
      <?php endwhile; ?>
    </select>

    <input type="text" name="goal_scorers" placeholder="Goal Scorer(s)">
    <input type="text" name="assists" placeholder="Assist(s)">
    <input type="text" name="man_of_the_match" placeholder="Man of the Match">
    <input type="text" name="player_of_the_month" placeholder="Player of the Month">
    <button type="submit" name="add">Add Fixture</button>
  </form>

  <!-- Tabel Data -->
  <table>
    <thead>
      <tr>
        <th>Month</th>
        <th>Tournament</th>
        <th>Ground</th>
        <th>Score</th>
        <th>Opponent</th>
        <th>Goal Scorer(s)</th>
        <th>Assist(s)</th>
        <th>Man of the Match</th>
        <th>Player of the Month</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = mysqli_fetch_assoc($result)) : ?>
      <tr>
        <td><?= $row['month'] ?></td>
        <td><?= $row['tournament_name'] ?></td>
        <td><?= $row['ground'] ?></td>
        <td><?= $row['score'] ?></td>
        <td><?= $row['opponent_name'] ?></td>
        <td><?= $row['goal_scorers'] ?></td>
        <td><?= $row['assists'] ?></td>
        <td><?= $row['man_of_the_match'] ?></td>
        <td><?= $row['player_of_the_month'] ?></td>
        <td>
          <a href="fixtures.php?delete=<?= $row['id'] ?>" class="btn-delete" onclick="return confirm('Yakin mau hapus data ini?')">Delete</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
</body>
</html>
