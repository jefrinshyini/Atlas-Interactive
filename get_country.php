<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $country = $_POST['country'];
    $details = $_POST['details']; // array of selected checkboxes

    $sql = "SELECT * FROM countries WHERE code=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $country);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        if (in_array("img", $details)) {
            echo "<h3>Images</h3>";
            echo "<img src='{$row['img1']}'>";
            echo "<img src='{$row['img2']}'>";
        }
        if (in_array("food", $details)) {
            echo "<h3>Food</h3><p>{$row['food']}</p>";
        }
        if (in_array("culture", $details)) {
            echo "<h3>Culture</h3><p>{$row['culture']}</p>";
        }
        if (in_array("table", $details)) {
            echo "<table><tr><th>Aspect</th><th>Details</th></tr>";
            echo "<tr><td>Capital</td><td>{$row['capital']}</td></tr>";
            echo "<tr><td>Currency</td><td>{$row['currency']}</td></tr>";
            echo "<tr><td>Language</td><td>{$row['language']}</td></tr>";
            echo "<tr><td>Population</td><td>{$row['population']}</td></tr>";
            echo "<tr><td>Continent</td><td>{$row['continent']}</td></tr>";
            echo "</table>";
        }
    } else {
        echo "No details found.";
    }
}
?>
