<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "User not logged in"]);
    exit;
}

$user_id = $_SESSION['user_id'];
$score = $_POST['score'];

$sql = "INSERT INTO quiz_results (user_id, score) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $user_id, $score);
$stmt->execute();

echo json_encode(["status" => "success"]);
?>
