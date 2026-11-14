<?php
session_start();
include 'db.php';

$sql = "SELECT u.username, AVG(q.score) AS avg_score, COUNT(q.id) AS attempts
        FROM users u
        JOIN quiz_results q ON u.id = q.user_id
        GROUP BY u.id
        ORDER BY avg_score DESC";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Leaderboard</title>
  <style>
    body { background:#0d1117; color:#e6edf3; font-family:Consolas, monospace; text-align:center; }
    table { width:70%; margin:40px auto; border-collapse:collapse; }
    th,td { border:1px solid #58a6ff; padding:10px; }
    th { background:#161b22; color:#58a6ff; }
    .header{
      display:flex;
      justify-content:space-between;
      align-items:center;
      padding:10px 40px;
      background:#9ecbff;
      border-bottom:2px solid #58a6ff;
    }
    .header h1{
      margin:0;
      color:#000;
      font-style:normal;
      font-size:26px;
    }
     .btn-group a{
      padding:6px 12px;
      background:#fff;
      color:#000;
      border:1px solid #000;
      border-radius:6px;
      text-decoration:none;
      font-weight:bold;
      margin-left:8px;
    }
    .btn-group a:hover{
      background:#000;
      color:#9ecbff;
    }
  </style>
</head>
<body>
    <div class="header">
    <h1>Leaderboard</h1>
    <div class="btn-group">
      <a href="index.php">Home</a>
      <a href="quiz.php">Take Quiz</a>
      <a href="compare-all.php">Compare Countries</a>
      <a href="logout.php">Logout</a>
    </div>
  </div>
  <h1>Quiz Leaderboard</h1>
  <table>
    <tr><th>Username</th><th>Average Score</th><th>Attempts</th></tr>
    <?php while($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?php echo htmlspecialchars($row['username']); ?></td>
        <td><?php echo $row['avg_score']; ?></td>
        <td><?php echo $row['attempts']; ?></td>
      </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>
