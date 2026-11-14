<?php
session_start();
include 'db.php';

// Ensure user is logged in
if(!isset($_SESSION['user_id'])){
    header("Location: login.html");
    exit;
}

$user_id = $_SESSION['user_id'];
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "Guest";


// Fetch quiz results for this user
$sql = "SELECT * FROM quiz_results WHERE user_id=? ORDER BY date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Your Quiz Results</title>
  <style>
    body{
      background:#0d1117;
      color:#e6edf3;
      font-family:Consolas, monospace;
      font-weight:bold;
      font-style:italic;
      text-align:center;
      margin:0;
      padding:0;
    }
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
    .box{
      width:750px;
      margin:40px auto;
      padding:25px;
      border:1px solid #58a6ff;
      border-radius:10px;
      box-shadow:0 0 15px #58a6ff;
    }
    table{
      width:100%;
      border-collapse:collapse;
      margin-top:20px;
    }
    th,td{
      border:1px solid #58a6ff;
      padding:10px;
      text-align:center;
    }
  </style>
</head>
<body>

  <div class="header">
    <h1>Quiz Dashboard</h1>
    <div class="btn-group">
      <a href="index.php">Home</a>
      <a href="quiz.php">Take Quiz</a>
      <a href="compare-all.php">Compare Countries</a>
      <a href="logout.php">Logout</a>
    </div>
  </div>

  <div class="box">
    <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
    <h3>Your Quiz Results</h3>
    <table>
      <tr>
        <th>Username</th>
        <th>Date</th>
        <th>Score</th>
      </tr>
      <?php while($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?php echo htmlspecialchars($username); ?></td>
          <td><?php echo $row['date']; ?></td>
          <td><?php echo $row['score']; ?></td>
        </tr>
      <?php endwhile; ?>
    </table>
  </div>

</body>
</html>
