<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Atlas Interactive</title>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@600;700&family=Poppins:wght@400;500&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    body {
      margin: 0;
      padding: 0;
      background: #0d1117;
      color: #e6edf3;
      font-family: Consolas, monospace;
      font-weight: bold;
      font-style: italic;
      text-align: center;
    }

    .top-nav {
      position: relative;
      text-align: right;
      top: 20px;
      right: 30px;
      z-index: 1000;
    }

    .top-nav a {
      text-decoration: none;
    }

    .top-nav button {
      padding: 8px 16px;
      margin-left: 10px;
      background: #0d1117;
      color: #58a6ff;
      border: 1px solid #58a6ff;
      border-radius: 8px;
      cursor: pointer;
      font-family: Consolas, monospace;
      font-weight: bold;
    }

    .top-nav button:hover {
      background: #58a6ff;
      color: #0d1117;
    }

    .location-button {
      margin-top: 20px;
      padding: 10px 20px;
      font-size: 16px;
      background: #ffba08;
      color: #0d1117;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-family: Consolas, monospace;
      font-weight: bold;
    }

    .location-button:hover {
      background: #0d1117;
      color: #ffba08;
      border: 2px solid #ffba08;
    }

    .result {
      margin-top: 10px;
      font-size: 18px;
      color: #58a6ff;
      font-family: Consolas, monospace;
      font-weight: bold;
    }

    h1 {
      font-family: 'Orbitron', sans-serif;
      font-style: normal;
      font-weight: 700;
      letter-spacing: 3px;
      color: #58a6ff;
      text-shadow: 0 0 8px #58a6ff, 0 0 16px rgba(88,166,255,0.6);
      margin-top: 20px;
      text-align: left;
      margin-left: 40px;
    }

    .subtitle {
      font-family: 'Orbitron', sans-serif;
      font-style: normal;
      font-weight: 500;
      font-size: 15px;
      color: #ffffff;
      margin-bottom: 20px;
      letter-spacing: 1px;
      text-align: left;
      margin-left: 40px;
    }

    .map-container {
      position: relative;
      width: 1000px;
      margin: auto;
    }

    .map-img {
      width: 95%;
      filter: brightness(0.8);
    }

    .continent {
      position: absolute;
    }

    .continent button {
      display: none;
      padding: 6px 14px;
      background: #0d1117;
      color: #58a6ff;
      border: 1px solid #58a6ff;
      border-radius: 6px;
      cursor: pointer;
      font-family: Consolas, monospace;
      font-weight: bold;
    }

    .continent:hover button {
      display: block;
    }

    .continent button:hover {
      background: #58a6ff;
      color: #0d1117;
    }

    a {
      text-decoration: none;
    }
  </style>

  <script>
    function findContinent() {
      if (!navigator.geolocation) {
        document.getElementById("result").innerText = "Geolocation not supported";
        return;
      }

      navigator.geolocation.getCurrentPosition(function(pos) {
        let lat = pos.coords.latitude;
        let lon = pos.coords.longitude;
        let continent = "Unknown";

        if (lat > 7 && lon < -30) continent = "North America";
        else if (lat < 12 && lat > -60 && lon < -30) continent = "South America";
        else if (lat > 35 && lon > -10 && lon < 40) continent = "Europe";
        else if (lat > -35 && lat < 35 && lon > -20 && lon < 55) continent = "Africa";
        else if (lat > 5 && lon > 40 && lon < 180) continent = "Asia";
        else if (lat < -10 && lon > 110 && lon < 180) continent = "Australia";
        else if (lat < -60) continent = "Antarctica";

        document.getElementById("result").innerText = "You are in: " + continent;
      }, function() {
        document.getElementById("result").innerText = "Location access denied";
      });
    }
  </script>
  <script>
$(document).ready(function(){

  // 1. Fade-in map and nav buttons on page load
  $(".map-container").hide().fadeIn(1500);
  $(".top-nav button").hide().slideDown(800);

  // 2. Hover glow on continents
  $(".continent").hover(
    function(){ 
      $(this).find("button").fadeIn(300).css("box-shadow","0 0 10px #58a6ff"); 
    },
    function(){ 
      $(this).find("button").fadeOut(300).css("box-shadow","none"); 
    }
  );

  // 3. Pulse animation for "Where Am I?" button
  setInterval(function(){
    $(".location-button").animate({opacity:0.5},500)
                         .animate({opacity:1},500);
  }, 2000);

  // 5. Typing effect for subtitle
  let text = "Start Exploring the World!!";
  let i = 0;
  function typeEffect(){
    if(i < text.length){
      $(".subtitle").append(text.charAt(i));
      i++;
      setTimeout(typeEffect, 100);
    }
  }
  $(".subtitle").text(""); // clear existing text
  typeEffect();

});
</script>

</head>

<body>

<div class="top-nav">
   <span style="color:#9ecbff; margin-right:20px;">
    <?php if(isset($_SESSION['username'])) echo "Welcome, " . htmlspecialchars($_SESSION['username']); ?>
  </span>
  <a href="video.html"><button>Video Tour</button></a>
  <a href="compare-all.php"><button>Compare Countries</button></a>
  <a href="quiz.php"><button>Quiz</button></a>
  <?php if(isset($_SESSION['user_id'])): ?>
    <a href="dashboard.php"><button>Dashboard</button></a>
    <a href="logout.php"><button>Logout</button></a>
    <a href = "leaderboard.php"><button> Leaderboard</button></a>
  <a href="wishlist.php"><button>Wishlist</button></a>
  <?php else: ?>
    <a href="login.html"><button>Login</button></a>
    <a href="signup.html"><button>Signup</button></a>
    
  <?php endif; ?>
</div>

  <h1>ATLAS INTERACTIVE</h1>
  <div class="subtitle">Start Exploring the World!!</div>
  
  <button class="location-button" onclick="findContinent()">Where Am I?</button>
  <div id="result" class="result"></div>

  <div class="map-container">
    <img src="https://storage.googleapis.com/kami-uploads-public/library-resource-zgnLT1JkrtFU-dLJMBi-blank-continents-map-png" class="map-img">

    <div class="continent" style="top:18%; left:15%; width:18%; height:15%;">
      <a href="nac.html"><button>North America</button></a>
    </div>

    <div class="continent" style="top:52%; left:22%; width:12%; height:20%;">
      <a href="sac.html"><button>South America</button></a>
    </div>

    <div class="continent" style="top:20%; left:47%; width:12%; height:12%;">
      <a href="europec.html"><button>Europe</button></a>
    </div>

    <div class="continent" style="top:37%; left:46%; width:14%; height:18%;">
      <a href="africac.html"><button>Africa</button></a>
    </div>

    <div class="continent" style="top:20%; left:65%; width:38%; height:15%;">
      <a href="asiac.html"><button>Asia</button></a>
    </div>

    <div class="continent" style="top:60%; left:75%; width:10%; height:12%;">
      <a href="australiac.html"><button>Australia</button></a>
    </div>

    <div class="continent" style="top:81%; left:45%; width:30%; height:10%;">
      <a href="antarticad.html"><button>Antarctica</button></a>
    </div>
  </div>

</body>
</html>
