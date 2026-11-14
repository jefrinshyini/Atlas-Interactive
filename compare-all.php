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
  <title>Global Country Comparison</title>

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
      width: 800px;
      margin: 40px auto;
      padding: 25px;
      border: 1px solid #58a6ff;
      border-radius: 10px;
      box-shadow: 0 0 15px #58a6ff;
    }

    select, button {
      padding: 10px;
      margin: 10px;
      background: #0d1117;
      color: #58a6ff;
      border: 1px solid #58a6ff;
      font-family: Consolas, monospace;
      font-weight: bold;
      cursor: pointer;
    }

    button:hover, select:hover {
      background: #161b22;
    }

    .result {
      margin-top: 20px;
      text-align: left;
    }

    ul {
      list-style-type: lower-alpha;
      padding-left: 20px;
    }
  </style>
</head>

<body>

  <div class="header">
    <h1>Global Country Comparison</h1>
    <a href="index.php">Home</a>
  </div>

  <div class="box">
    <select id="c1">
      <option value="">Select Country 1</option>
      <option value="india">India (Asia)</option>
      <option value="jordan">Jordan (Asia)</option>
      <option value="france">France (Europe)</option>
      <option value="switzerland">Switzerland (Europe)</option>
      <option value="brazil">Brazil (South America)</option>
      <option value="peru">Peru (South America)</option>
      <option value="usa">USA (North America)</option>
      <option value="uk">UK (North America)</option>
      <option value="newzealand">New Zealand (Australia)</option>
      <option value="australia">Australia (Australia)</option>
      <option value="papuanewguinea">Papua New Guinea (Australia)</option>
      <option value="southafrica">South Africa (Africa)</option>
      <option value="egypt">Egypt (Africa)</option>
    </select>

    <select id="c2">
      <option value="">Select Country 2</option>
      <option value="india">India (Asia)</option>
      <option value="jordan">Jordan (Asia)</option>
      <option value="france">France (Europe)</option>
      <option value="switzerland">Switzerland (Europe)</option>
      <option value="brazil">Brazil (South America)</option>
      <option value="peru">Peru (South America)</option>
      <option value="usa">USA (North America)</option>
      <option value="uk">UK (North America)</option>
      <option value="newzealand">New Zealand (Australia)</option>
      <option value="australia">Australia (Australia)</option>
      <option value="papuanewguinea">Papua New Guinea (Australia)</option>
      <option value="southafrica">South Africa (Africa)</option>
      <option value="egypt">Egypt (Africa)</option>
    </select>

    <br>
    <button onclick="compare()">Compare</button>

    <div class="result">
      <h3>Country 1</h3>
      <p id="r1"></p>

      <h3>Country 2</h3>
      <p id="r2"></p>
    </div>
  </div>

  <script>
    var data = {
      india: { capital: "New Delhi", currency: "INR", continent: "Asia", population: "1.4 Billion", language: "Hindi, English" },
      jordan: { capital: "Amman", currency: "Dinar", continent: "Asia", population: "10 Million", language: "Arabic" },
      france: { capital: "Paris", currency: "Euro", continent: "Europe", population: "67 Million", language: "French" },
      switzerland: { capital: "Bern", currency: "Swiss Franc", continent: "Europe", population: "8.7 Million", language: "German, French, Italian, Romansh" },
      brazil: { capital: "Brasília", currency: "Real", continent: "South America", population: "213 Million", language: "Portuguese" },
      peru: { capital: "Lima", currency: "Sol", continent: "South America", population: "33 Million", language: "Spanish" },
      usa: { capital: "Washington D.C.", currency: "US Dollar", continent: "North America", population: "331 Million", language: "English" },
      uk: { capital: "London", currency: "Pound Sterling", continent: "North America", population: "67 Million", language: "English" },
      newzealand: { capital: "Wellington", currency: "NZ Dollar", continent: "Oceania", population: "5 Million", language: "English, Maori" },
      australia: { capital: "Canberra", currency: "Australian Dollar", continent: "Oceania", population: "26 Million", language: "English" },
      papuanewguinea: { capital: "Port Moresby", currency: "Kina", continent: "Oceania", population: "9 Million", language: "English, Tok Pisin, Hiri Motu" },
      southafrica: { capital: "Pretoria", currency: "Rand", continent: "Africa", population: "60 Million", language: "Zulu, Xhosa, Afrikaans, English" },
      egypt: { capital: "Cairo", currency: "Egyptian Pound", continent: "Africa", population: "104 Million", language: "Arabic" }
    };

    function compare() {
      var c1 = document.getElementById("c1").value;
      var c2 = document.getElementById("c2").value;

      if (c1 && c2) {
        r1.innerHTML = "<ul>" +
          "<li>Capital: " + data[c1].capital + "</li>" +
          "<li>Currency: " + data[c1].currency + "</li>" +
          "<li>Continent: " + data[c1].continent + "</li>" +
          "<li>Population: " + data[c1].population + "</li>" +
          "<li>Official Language: " + data[c1].language + "</li>" +
          "</ul>";

        r2.innerHTML = "<ul>" +
          "<li>Capital: " + data[c2].capital + "</li>" +
          "<li>Currency: " + data[c2].currency + "</li>" +
          "<li>Continent: " + data[c2].continent + "</li>" +
          "<li>Population: " + data[c2].population + "</li>" +
          "<li>Official Language: " + data[c2].language + "</li>" +
          "</ul>";
      } else {
        alert("Please select both countries to compare.");
      }
    }
  </script>

</body>
</html>
