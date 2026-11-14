<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $password);
    $stmt->execute();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Signup Successful</title>
  <style>
    body { background:#0d1117; color:#58a6ff; font-family:Consolas, monospace; text-align:center; }
    a { display:inline-block; margin-top:20px; padding:10px 20px; background:#58a6ff; color:#0d1117; border-radius:6px; text-decoration:none; }
    a:hover { background:#0d1117; color:#58a6ff; border:1px solid #58a6ff; }
  </style>
</head>
<body>
  <h1>Signup Successful!</h1>
  <p>You can now log in with your new account.</p>
  <a href="login.html">Go to Login</a>
</body>
</html>
