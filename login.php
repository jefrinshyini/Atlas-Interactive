<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        // Store both ID and username in session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        // Redirect to dashboard
        header("Location: index.php");
        exit;
    } else {
        $error = "Invalid credentials!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@600;700&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      background: #0d1117;
      color: #e6edf3;
      font-family: Consolas, monospace;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login-box {
      background: #161b22;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 0 20px #58a6ff;
      width: 350px;
      text-align: center;
    }

    .login-box h1 {
      font-family: 'Orbitron', sans-serif;
      font-weight: 700;
      font-size: 28px;
      color: #58a6ff;
      margin-bottom: 20px;
      text-shadow: 0 0 8px #58a6ff;
    }

    .login-box input {
      width: 90%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #58a6ff;
      border-radius: 8px;
      background: #0d1117;
      color: #e6edf3;
      font-weight: bold;
      font-family: Consolas, monospace;
    }

    .login-box input:focus {
      outline: none;
      border-color: #ffba08;
      box-shadow: 0 0 8px #ffba08;
    }

    .login-box button {
      width: 95%;
      padding: 12px;
      margin-top: 15px;
      background: #58a6ff;
      color: #0d1117;
      border: none;
      border-radius: 8px;
      font-weight: bold;
      cursor: pointer;
      font-family: Consolas, monospace;
    }

    .login-box button:hover {
      background: #0d1117;
      color: #58a6ff;
      border: 2px solid #58a6ff;
    }

    .login-box p {
      margin-top: 15px;
      font-size: 14px;
      color: #9ecbff;
    }

    .login-box a {
      color: #ffba08;
      text-decoration: none;
      font-weight: bold;
    }

    .login-box a:hover {
      text-decoration: underline;
    }

    .error {
      color: red;
      margin-top: 10px;
    }
  </style>
</head>
<body>

<div class="login-box">
  <h1>Login</h1>
  <?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>
  <form method="POST" action="">
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Login</button>
  </form>
  <p>Don't have an account? <a href="signup.php">Sign up</a></p>
</div>

</body>
</html>
