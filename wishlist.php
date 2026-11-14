<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Wishlist</title>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@600;700&family=Poppins:wght@400;500&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    body {
      background:#0d1117;
      color:#e6edf3;
      font-family:Consolas, monospace;
      text-align:center;
      padding-top:50px;
    }
    .wishlist-box {
      background:#161b22;
      padding:20px;
      border-radius:12px;
      width:400px;
      margin:auto;
      box-shadow:0 0 15px #58a6ff;
    }
    input {
      width:80%;
      padding:10px;
      margin:10px 0;
      border:1px solid #58a6ff;
      border-radius:8px;
      background:#0d1117;
      color:#e6edf3;
    }
    button {
      padding:10px 20px;
      background:#58a6ff;
      color:#0d1117;
      border:none;
      border-radius:8px;
      cursor:pointer;
      font-weight:bold;
    }
    button:hover {
      background:#0d1117;
      color:#58a6ff;
      border:2px solid #58a6ff;
    }
    ul {
      list-style:none;
      padding:0;
    }
    li {
      margin:8px 0;
      padding:6px;
      background:#0d1117;
      border:1px solid #58a6ff;
      border-radius:6px;
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
<div class="wishlist-box">
  <h1>My Travel Wishlist</h1>
  <input type="text" id="place" placeholder="Enter a place">
  <button id="addBtn">Add to Wishlist</button>
  <ul id="wishlist"></ul>
</div>

<script>
$(document).ready(function(){
  // Load existing wishlist on page load
  $.get("wishlist_api.php", function(data){
    let items = JSON.parse(data);
    items.forEach(function(item){
      $("#wishlist").append("<li>"+item+"</li>");
    });
  });

  // Add new item via AJAX
  $("#addBtn").click(function(){
    let place = $("#place").val();
    if(place.trim() === "") return;

    $.post("wishlist_api.php", { place: place }, function(data){
      let items = JSON.parse(data);
      $("#wishlist").empty();
      items.forEach(function(item){
        $("#wishlist").append("<li>"+item+"</li>");
      });
      $("#place").val(""); // clear input
    });
  });
});
</script>

</body>
</html>
