<form action= '/fullstack/bandscreate.php' method= "post">
<!--tabel bands --->
<input name ='name' type='text'> 
<input type = 'submit'>
<input type="checkbox" id="genres1" name="genre[]" value="Pop">
<input type="checkbox" id="genres2" name="genre[]" value="Rock">
<input type="checkbox" id="genres3" name="genre[]" value="Hip-Hop">
<input type="checkbox" id="genres4" name="genre[]" value="Metal">
<input type="date" id="datum" name="date" value="date">
<input type="time" id="tijd" name="time" value="time">


</form>

<?php
include('database.php');



   
if(isset($_POST['genre'])) {
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
        $date = $_POST['date'];
        $time = $_POST['time'];

        if ($name != '' && $date != '' && $time != '') {
            $genre = implode(',', $_POST['genre']);
            
            $sql = $conn->prepare("INSERT INTO bands (BandNaam, Genre, Datum, Tijd) VALUES (?, ?, ?, ?)");
            
            if ($sql) {
                $sql->bind_param("ssss", $name, $genre, $date, $time);
                $sql->execute();
                $sql->close(); 
                echo "Data inserted successfully!";
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "Informatie niet toegevoegd!";
        }
    } 
} else {
    echo "Informatie niet toegevoegd! ";
} 

?>
