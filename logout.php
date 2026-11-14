<?php
session_start();

// Destroy all session data
session_unset();
session_destroy();

// Redirect to login page (or index.php if you prefer)
header("Location: index.php");
exit;
?>
