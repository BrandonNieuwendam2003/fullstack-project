<form action="/fullstack/event.php" method="post">
    <label for="datum">Datum van optreden</label>
    <input type="date" id="datum" name="datum">
    
    <label for="tijd">Tijd van optreden</label>
    <input type="time" id="tijd" name="tijd">
    
    <label for="eventnaam">Naam van het event</label>
    <input type="text" id="eventnaam" name="eventnaam">
    
    <label for="entreeprijs">Entreeprijs</label>
    <input type="number" min="1" step="any" id="entreeprijs" name="entreeprijs">
    
    <input type="submit">
</form>



<?php
include('database.php');

$sqlbands = "SELECT idbands, BandNaam, Genre FROM bands";

$result = $conn->query($sqlbands);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo "id: " . $row["idbands"]. " - BandNaam: " . $row["BandNaam"]. " - Genre(s): " . $row["Genre"]. "<br>";
    }
  } else {
    echo "0 bands! ";
  }
 

$date = isset($_POST['datum']) ? $_POST['datum'] : '';
$time = isset($_POST['tijd']) ? $_POST['tijd'] : '';
$evnaam = isset($_POST['eventnaam']) ? $_POST['eventnaam'] : '';
$enprijs = isset($_POST['entreeprijs']) ? $_POST['entreeprijs'] : '';
if($time != '' && $date != '' && $evnaam != '' && $enprijs != ''){

    $sqlevent = $conn->prepare("INSERT INTO events (Datum, AanvangsTijd, EventNaam, EntreePrijs) VALUES (?, ?, ?, ?)");
                       
    if ($sqlevent) {
        $sqlevent->bind_param("ssss", $date, $time, $evnaam, $enprijs);
        $sqlevent->execute();
        $sqlevent->close();
        echo 'event added';
    }else {
            echo "Error: " . $conn->error;
        }
        
    
    }else {
    echo "Data niet toegevoegd!";
}

?>
