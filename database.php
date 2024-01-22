<!-- hier wordt de database connectie vastgelegt, dbname is naam van je database. Wij werken niet met password dus password = ""
Username is altijd root bij ons, en we werken met localhost dus dat is de servernaam.-->

<?php
$dbname = "cafe";
$password = "";
$username = 'root';
$servername = 'localhost';

// hier wordt de connectie vastgelegt met alle data die wij hebben gegeven. als hij geen connectie kan maken geeft ie een error
$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>