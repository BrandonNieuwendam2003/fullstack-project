<!-- CHECK BAND.PHP VOOR UITLEG OVER HTML EN GEDEELTES PHP DIE HIER NIET OPNIEUW BEHANDELD WORDT!!-->
<!-- CHECK BAND.PHP VOOR UITLEG OVER HTML EN GEDEELTES PHP DIE HIER NIET OPNIEUW BEHANDELD WORDT!!-->
<!-- CHECK BAND.PHP VOOR UITLEG OVER HTML EN GEDEELTES PHP DIE HIER NIET OPNIEUW BEHANDELD WORDT!!-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Menu - Music Cafe</title>
    <link rel="stylesheet" href="menu.css">
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
            <h2>Rooster</h2>
            <div class="menu-item">
              
                
            </div>
            <div class="menu-item">
             
            
                
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2023 Music Cafe. All rights reserved.</p>
    </footer>
</body>
<?php
include('database.php');
//hier wordt een variabele $sqlevent aangemaakt, en deze variabel heeft de waarde van events.* en bands.*
//dit is simpel gezegt: tabel event alle collumen en tabel band alle collumen, Hij geeft ook aan FROM tussentabel
//de primary keys van tussentabel worden gebruikt om de data van de primary keys van band en events te pakken,
//stel, we hebben 3 bands, id 21 beatles, id 22 nig, id 23 black. Als ik in tussentabel event id 44 heb met band id 22.
//dan heeft die band id een referentie naar band nig met zijn genres, en event id 44 naar event met id 44 (dit gebeurt met innerjoin)
$sqlevent = "SELECT events.*, bands.*
FROM tussentabel
INNER JOIN events ON tussentabel.events = events.idevents
INNER JOIN bands ON tussentabel.bands = bands.idbands";

$result = $conn->query($sqlevent);

//hier wordt gechecked of de connectie iets terug geeft, als dat niet van spraken is is er een slechte connectie
//en geeft ie een error
if ($result === false) {
    die("Error executing the query: " . $conn->error);
}
//hier wordt de tabel aangemaakt die alles laat zien. in de menu.css wordt dit gestyled (ik kan het niet echt uitleggen, chatgpt ;)
if ($result->num_rows > 0) {
    echo '<table class="table-container">';
    echo '<tr><th>BandNaam</th><th>Genre(s)</th><th>Datum</th><th>Begintijd<th>EventNaam</th><th>EntreePrijs</th></tr>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row["BandNaam"] . '</td>';
        echo '<td>' . $row["Genre"] . '</td>';
        echo '<td>' . $row["Datum"] . '</td>';
        echo '<td>' . $row["Begintijd"] . '</td>';
        echo '<td>' . $row["EventNaam"] . '</td>';
        echo '<td>' . $row["EntreePrijs"] . '</td>';
        echo '</tr>';
    }

    echo '</table>';
} else {
    echo "0 events!";
}

$conn->close();
  ?>

