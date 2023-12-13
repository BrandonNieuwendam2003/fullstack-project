<form action= '/fullstack/bandscreate.php' method= "post">
<input name ='name' type='text'> 
<input type = 'submit'>
<input type="checkbox" id="genres1" name="genre[]" value="Pop">
<input type="checkbox" id="genres2" name="genre[]" value="Rock">
<input type="checkbox" id="genres3" name="genre[]" value="Hip-Hop">
<input type="checkbox" id="genres4" name="genre[]" value="Metal">
<input type="date" id="datum" name="date" value="date">

</form>
<script>
alert("Hello! I am an alert box!!");
    </script>

<?php
include('database.php');



   
if(isset($_POST['genre'])) {
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
        $date = $_POST['date'];

        if ($name != '') {
            $genre = implode(',', $_POST['genre']);
            
            $sql = $conn->prepare("INSERT INTO bands (BandNaam, Genre, Datum) VALUES (?, ?,?)");
            
            if ($sql) {
                $sql->bind_param("sss", $name, $genre, $date);
                $sql->execute();
                $sql->close(); 
                echo "Data inserted successfully!";
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "Geen naam toegevoegd";
        }
    } 
} else {
    echo "Geen genre toegevoegd";
} 

?>
