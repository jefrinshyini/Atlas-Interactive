<?php
session_start();

// If not logged in, redirect to login
if(!isset($_SESSION['user_id'])){
    header("Location: login.html");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>World Quiz</title>

  <style>
    body {
      background: #0d1117;
      color: #e6edf3;
      font-family: Consolas, monospace;
      font-weight: bold;
      font-style: italic;
      text-align: center;
      margin: 0;
      padding: 0;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 40px;
      background: #9ecbff;
      border-bottom: 2px solid #58a6ff;
    }

    .header h1 {
      margin: 0;
      color: #000000;
      font-style: normal;
      font-size: 26px;
    }

    .header a {
      padding: 6px 12px;
      background: #ffffff;
      color: #000000;
      border: 1px solid #000000;
      border-radius: 6px;
      font-family: Consolas, monospace;
      font-weight: bold;
      text-decoration: none;
      cursor: pointer;
      font-size: 14px;
    }

    .header a:hover {
      background: #000000;
      color: #9ecbff;
    }

    .box {
      width: 650px;
      margin: 40px auto;
      padding: 25px;
      border: 1px solid #58a6ff;
      border-radius: 12px;
      text-align: left;
    }

    input[type="radio"], input[type="text"] {
      margin: 5px 0;
    }

    button {
      padding: 10px;
      margin-top: 15px;
      background: #0d1117;
      color: #58a6ff;
      border: 1px solid #58a6ff;
      font-family: Consolas, monospace;
      font-weight: bold;
      cursor: pointer;
    }

    button:hover {
      background: #58a6ff;
      color: #0d1117;
    }

    footer {
      margin-top: 30px;
      padding: 25px;
      background: #161b22;
      color: #58a6ff;
      font-size: 24px;
      font-weight: bold;
    }
  </style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    window.onload = function () {
      let firstTime = confirm("Are you attending this quiz for the first time?");
      if (firstTime) {
        let email = prompt("Please enter your email ID:");
        if (email !== null) {
          email = email.trim();
          const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
          if (!emailRegex.test(email)) {
            alert("Invalid email format. Please reload the page and enter a valid email.");
          } else {
            alert("Welcome! You may start the quiz 😊");
            console.log(email);
          }
        }
      }
    };

    function check() {
      let score = 0;
      let answers = {
        q1: 'q1',
        q2: 'q2',
        q3: 'q3',
        q4: 'q4',
        q6: 'q6',
        q7: 'q7',
        q8: 'q8',
        q9: 'q9',
        q10: 'q10',
        q11: 'q11',
        q12: 'q12',
        q13: 'q13',
        q14: 'q14'
      };

      for (let key in answers) {
        if (document.getElementById(answers[key]).checked) score++;
      }

      const q5Value = document.getElementById("q5Input").value.trim();
    const regex = /^(France|Germany|Italy)$/i;
    if (regex.test(q5Value)) score++;

    let output = "Score: " + score + "/14";
    if (score >= 10) output += " 🏆";
    document.getElementById("result").innerHTML = output;

    // ✅ NEW: Send score to PHP via AJAX
    $.ajax({
      url: "save_result.php",
      type: "POST",
      data: { score: score },
      success: function(response) {
        console.log("Result saved:", response);
        alert("Your score has been saved!");
        window.location.href = "dashboard.php"; // redirect after saving
      },
      error: function() {
        alert("Error saving result.");
      }
    });
  }
</script>
</head>

<body>

  <div class="header">
    <h1>World Quiz</h1>
    <a href="index.php">Home</a>
  </div>

  <div class="box">

    <p>1. Capital of India?</p>
    <input type="radio" name="a1" id="q1"> New Delhi<br>
    <input type="radio" name="a1"> Mumbai<br>
    <input type="radio" name="a1"> Kolkata<br>

    <p>2. Currency of Jordan?</p>
    <input type="radio" name="a2"> Riyal<br>
    <input type="radio" name="a2"> Pound<br>
    <input type="radio" name="a2" id="q2"> Dinar<br>

    <p>3. Capital of France?</p>
    <input type="radio" name="a3" id="q3"> Paris<br>
    <input type="radio" name="a3"> Lyon<br>
    <input type="radio" name="a3"> Marseille<br>

    <p>4. Currency of Brazil?</p>
    <input type="radio" name="a4"> Peso<br>
    <input type="radio" name="a4" id="q4"> Real<br>
    <input type="radio" name="a4"> Dollar<br>

    <p>5. Which of these countries is in Europe? (Type the name)</p>
    <input type="text" id="q5Input" placeholder="France, Germany, Italy"
      style="padding:6px; border-radius:6px; border:1px solid #58a6ff;"><br>

    <p>6. Official language of Egypt?</p>
    <input type="radio" name="a5"> English<br>
    <input type="radio" name="a5"> French<br>
    <input type="radio" name="a5" id="q5"> Arabic<br>

    <p>7. Capital of Switzerland?</p>
    <input type="radio" name="a6" id="q6"> Bern<br>
    <input type="radio" name="a6"> Zurich<br>
    <input type="radio" name="a6"> Geneva<br>

    <p>8. Currency of USA?</p>
    <input type="radio" name="a7"> Pound<br>
    <input type="radio" name="a7" id="q7"> US Dollar<br>
    <input type="radio" name="a7"> Euro<br>

    <p>9. Capital of South Africa?</p>
    <input type="radio" name="a8" id="q8"> Pretoria<br>
    <input type="radio" name="a8"> Cape Town<br>
    <input type="radio" name="a8"> Johannesburg<br>

    <p>10. Capital of Jordan?</p>
    <input type="radio" name="a9"> Aqaba<br>
    <input type="radio" name="a9"> Irbid<br>
    <input type="radio" name="a9" id="q9"> Amman<br>

    <p>11. Currency of UK?</p>
    <input type="radio" name="a10" id="q10"> Pound Sterling<br>
    <input type="radio" name="a10"> Euro<br>
    <input type="radio" name="a10"> Dollar<br>

    <p>12. Capital of Peru?</p>
    <input type="radio" name="a11"> Cusco<br>
    <input type="radio" name="a11" id="q11"> Lima<br>
    <input type="radio" name="a11"> Arequipa<br>

    <p>13. Capital of New Zealand?</p>
    <input type="radio" name="a12" id="q12"> Wellington<br>
    <input type="radio" name="a12"> Auckland<br>
    <input type="radio" name="a12"> Christchurch<br>

    <p>14. Currency of Australia?</p>
    <input type="radio" name="a13"> NZ Dollar<br>
    <input type="radio" name="a13"> US Dollar<br>
    <input type="radio" name="a13" id="q13"> Australian Dollar<br>

    <p>15. Official language of Switzerland?</p>
    <input type="radio" name="a14"> German only<br>
    <input type="radio" name="a14"> French only<br>
    <input type="radio" name="a14" id="q14"> German, French, Italian, Romansh<br>

    <br>
    <button onclick="check()">Submit</button>
  </div>

  <footer id="result">Score will appear here</footer>

</body>
</html>
