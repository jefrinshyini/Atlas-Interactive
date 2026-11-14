<?php
session_start();


if(!isset($_SESSION['wishlist'])){
    $_SESSION['wishlist'] = [];
}


if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place'])){
    $place = trim($_POST['place']);
    if($place !== ""){
        $_SESSION['wishlist'][] = htmlspecialchars($place);
    }
}


echo json_encode($_SESSION['wishlist']);
