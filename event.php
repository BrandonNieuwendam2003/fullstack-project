<!-- CHECK BAND.PHP VOOR UITLEG OVER HTML EN GEDEELTES PHP DIE HIER NIET OPNIEUW BEHANDELD WORDT!!-->
<!-- CHECK BAND.PHP VOOR UITLEG OVER HTML EN GEDEELTES PHP DIE HIER NIET OPNIEUW BEHANDELD WORDT!!-->
<!-- CHECK BAND.PHP VOOR UITLEG OVER HTML EN GEDEELTES PHP DIE HIER NIET OPNIEUW BEHANDELD WORDT!!-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events - Music Cafe</title>
    <link rel="stylesheet" href="events.css">
</head>
<body>
    <header>
        <h1>Casus Cafe</h1>
        <nav>
            <ul>
                <li><a href="band.php">Registreer hier je band</a></li>
                <li><a href="event.php">Events</a></li>
                <li><a href="menu.php">Music Menu</a></li>
                <li><a href="about.html">About Us</a></li>
                <li><a href="contact.html">Contact</a></li>
                
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>Upcoming Events</h2>
            <div class="event">
              <p>Note: Aanvangstijd is 1 uur van te voren!<p>
                
            </div>
            <div class="event">
             
                
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2023 Music Cafe. All rights reserved.</p>
    </footer>
</body>






<?php
include('database.php');



// hier wordt een variabele aangemaakt die een connectie maakt met tabel 'events', De * betekent dat alle collumen geselecteerd zijn
$sqlevent = "SELECT * FROM events";
$resultevents = $conn->query($sqlevent);





//zelfde hier
$sqlbands = "SELECT idbands, BandNaam, Genre FROM bands";
$resultbands = $conn->query($sqlbands);

//Hier wordt een array aangemaakt voor bandsdate die we later gaan gebruiken

$bandsData = array();  

//en met later bedoel ik hier xd. Wat hier gebeurt is hij pakt $sqlbands hier boven dit. En fetch_assoc de rows
// fetch_assoc is dat hij de ingevulde waardes van een tabel pakt, dus bijvoorbeeld bandnaam the beatles met genre hip-hop.
//dit wordt gedaan via een while loop, Hij gaat elke keer dat ie loopt door ingevulde waardes heen totdat er geen meer zijn.

while ($row = $resultbands->fetch_assoc()) {
   
    $bandsData[] = $row;
}
?>

<!-- dit is een beetje raar, er staat html na de php, dit komt omdat wij de band moeten selecteren voor het event, we willen dat
bijvoorbeeld de beatles deze vrijdag bij event: Brandon pakt die banaan gaat spelen. dus we hebben eerst de data gefetched van de bands
en nu zorgen we dat we die data kunnen selecteren in de form en kunnen submitten in de tussentabel.-->
<form action="/fullstack/event.php" method="post">
    <label for="datum">Datum van optreden</label>
    <input  type="date" id="datum" required="true" name="datum" >
    <br>
    <label for="tijd">begintijd van de band</label>
    <input type="time" id="begintijd" required="true" name="begintijd">
    <br>
    <label for="eventnaam">Naam van het event</label>
    <input type="text" id="eventnaam" required="true" name="eventnaam">
    <br>
    <!-- dus hier gebeurt dat, de array veranderd van variabele en wordt gebruikt voor de form -->
    <label for="bands">Kies een band:</label>
    <?php
    foreach ($bandsData as $band) {
        echo '<input type="radio" id="bands_' . $band['idbands'] . '" name="idbands" value="' . $band['idbands'] . '"> ' . $band['BandNaam'] . ' - Genre(s): ' . $band['Genre'] . '<br>';
    }
    ?>
    <br>
    <label for="entreeprijs">Entreeprijs</label>
    <input type="number" required="true" min="1" step="any" id="entreeprijs" name="entreeprijs">
    <br>
    <input type="submit">
</form>
<?php
// hier wordt weer de isset gedaan check band.php voor meer uitleg


$bands = isset($_POST['idbands']) ? $_POST['idbands'] : '';
$date = isset($_POST['datum']) ? $_POST['datum'] : '';
$time = isset($_POST['begintijd']) ? $_POST['begintijd'] : '';
$evnaam = isset($_POST['eventnaam']) ? $_POST['eventnaam'] : '';
$enprijs = isset($_POST['entreeprijs']) ? $_POST['entreeprijs'] : '';

echo "Bands: " . print_r($bands, true) . "<br>";
echo "Date: " . $date . "<br>";
echo "Time: " . $time . "<br>";
echo "Event Name: " . $evnaam . "<br>";
echo "Entrance Price: " . $enprijs . "<br>";


if ($resultbands->num_rows > 0) {
   
       
    if($time != '' && $date != '' && $evnaam != '' && $enprijs != ''){

    $sqlevent = $conn->prepare("INSERT INTO events (Datum, Begintijd, EventNaam, EntreePrijs) VALUES (?, ?, ?, ?)");
         
    //ok hier gebeurt iets speciaals, eerst stoppen we data in events, En als dat succesvol is pakt hij via $conn->insert_id; 
    //de laatste geinserte id van events, En er wordt een nieuwe query geexecute. Dit wordt in tussentabel gestopt
    //Dus de lastinstertedid wordt er in gestopt, en de geselecteerde band bij de form. Wat dit doet is bij menu.php
    // kunnen we nu laten zien welke band bij welk event speelt. Als je kijkt in de database zie je dat er relaties staan,
    //dat is met de primary keys, dus met de 2 keys in tussentabel kunnen we zien welke band bij welk event hoort.
    if ($sqlevent) {
        $sqlevent->bind_param("ssss", $date, $time, $evnaam, $enprijs);
        $sqlevent->execute();
        $sqlevent->close();
        $lastInsertId = $conn->insert_id;
        $sqlAnotherTable = $conn->prepare("INSERT INTO tussentabel (events, bands) VALUES (?, ?)");
        $sqlAnotherTable->bind_param("ii", $lastInsertId, $bands);
        $sqlAnotherTable->execute();
        $sqlAnotherTable->close();

        echo 'event added';
       
    }else {
            echo "Error: " . $conn->error;
        }
    
    
    }else {
    echo "Vul alles in";
}

} 
   else {
    echo "<br> 0 bands! ";
}

?>
