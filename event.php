<form action= '/fullstack/event.php' method= "post">
<input type="date" id="datum" name="datum" value="datum">Datum van optreden</input>
<input type="time" id="tijd" name="tijd" value="tijd">Tijd van optreden</input>
<input type="text" id="eventnaam" name="eventnaam">Naam van het event</input>
<input type="number" min="1" step="any" id="entreeprijs" name="entreeprijs" value="entreeprijs">Eentreeprijs</input>
<input type = 'submit'>
</form>



<?php
include('database.php');
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
        echo "Event Added! ";
    } else {
        echo "Error: " . $conn->error;
    }
}else {
    echo "Data niet toegevoegd!";
} 
?>
