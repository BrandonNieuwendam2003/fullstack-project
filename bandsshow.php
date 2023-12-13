<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = "cafe";
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "SELECT * FROM bands";
$result = $conn->query($sql);
while($row = $result->fetch_array()){
    echo $row['bands'];
}
    if($result->num_rows > 0){
    }else{
        echo 'niks';

    }
?>