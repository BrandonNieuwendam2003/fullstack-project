<form action= '/fullstack/band.php' method= "post">
<input name ='bandnaam' type='text'>bandnaam</input> 
<input type="checkbox" id="genres1" name="genre[]" value="Pop">Pop</input>
<input type="checkbox" id="genres2" name="genre[]" value="Rock">Rock</input>
<input type="checkbox" id="genres3" name="genre[]" value="Hip-Hop">Hip-Hop</input>
<input type="checkbox" id="genres4" name="genre[]" value="Metal">Metal</input>
<input type = 'submit'>
</form>



<?php
include('database.php');
$name = isset($_POST['bandnaam']) ? $_POST['bandnaam'] : '';
$genre = isset($_POST['genre']) ? $_POST['genre'] : '';  
if ($name != '' && $genre != ''){
$genre = implode(',', $_POST['genre']);
$sqlbands = $conn->prepare("INSERT INTO bands (BandNaam, Genre) VALUES (?, ?)");
                       
if ($sqlbands) {
    $sqlbands->bind_param("ss", $name, $genre);
    $sqlbands->execute();
    $sqlbands->close(); 
    echo "Band Added! ";
} else {
    echo "Error: " . $conn->error;
}
}else {
    echo "Data niet toegevoegd!";
} 
?>
