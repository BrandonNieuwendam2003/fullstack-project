<!-- HTml voor de webpage-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Menu - Music Cafe</title>
    <link rel="stylesheet" href="index.css">
    <script src='band.js'></script>
</head>
<body>
    <header>
        <h1>Casus Cafe</h1>
        <nav>
            <ul>

            <!-- de shit waa je van pagina kan switchen-->
                <li><a href="band.php">Registreer hier je band</a></li>
                <li><a href="event.php">Events</a></li>
                <li><a href="menu.php">Music Menu</a></li>
                <li><a href="about.html">About Us</a></li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
        </nav>
    </header>

    
    
      

    <main>
        <!-- de forms, dit is waar je de infortmatie invult die via php wordt verstuurd naar de database. 
        Name is de naam van de input. Als je data wilt pakken van een form moet je een referentie maken naar de name.
        Required betekent of het ingevult MOET worden of nie, Type betekent wat het is:
        type text is bijvoorbeeld een textbalk en type date is een calender. value is leeg maar is de waarde van wat is ingevult.
        Bjvoorbeeld bij een checkbox is het true or false. -->

    <link rel='stylesheet' type='text/css' media='screen' href='band.css'>
<form action= '/fullstack/band.php' method= "post">

<label for="bandnaam">BandNaam</label>
<input name ='bandnaam' required="true" type='text'></input> 
<br>
<div class="checkbox-group required">
<label for="genres1">Pop</label>
<input type="checkbox" id="genres1" name="genre[]" value=" Pop"></input>
<br>
<label for="genres2">Rock</label>
<input type="checkbox" id="genres2" name="genre[]" value=" Rock"></input>
<br>
<label for="genres3">Hip-Hop</label>
<input type="checkbox" id="genres3" name="genre[]" value=" Hip-Hop"></input>
<br>
<label for="genres4">Metal</label>
<input type="checkbox" id="genres4" name="genre[]" value=" Metal"></input>
<br>
</div>

<input type = "submit">
</form>
        <section>
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
//hier wordt de database.php file geinclude, in de database.php file staat de connectie.
include('database.php');



  //hier worden er variables aangemaakt van wat er is ingevuld. Er wordt een referentie gemaakt naar de name van de input,
  //een isset pakt de informatiee en doet het via de POST manier. Dont ask me too much about this part i dont really know either xd

$name = isset($_POST['bandnaam']) ? $_POST['bandnaam'] : '';
$genre = isset($_POST['genre']) ? $_POST['genre'] : '';  

// Hier wordt gechecked of er minimaal 1 genre is ingevuld bij de checkboxes door te checken of $genre != '' (dus of hij niet niks is). 
//Required werkt niet omdat hij dan alleen werkt
//als je alles invult. Dus genre is een array, stel je voor je klikt optie 2 en 3 aan, dan geeft ie terug:
//genres["","Rock","Hip-Hop",""], met een implode pakt hij de ingevulde informatie en wordt dat vastgehouden.
if ($genre != ''){
$genre = implode(',', $_POST['genre']);

// hier wordt de connectie gemaakt, $sqlbands is een connectie met de bands tabel en Bandnaam en Genre als zijn geselecteerde colummen
//de ?, ? staan voor de waardes, de eerste ? is de waarde voor bandnaam en de 2de voor genre.
$sqlbands = $conn->prepare("INSERT INTO bands (BandNaam, Genre) VALUES (?, ?)");

//hier wordt het uitgevoerd, Met de bind_param geven we aan wat we willen stoppen in bandnaam en genre
// De ss staat voor string string, omdat we 2 strings invullen, als je een int een string wilt invullen zou je is moeten vullen
// $name en $genre zijn de waardes voor de vraagtekens, en boven kan je zien dat $name en $genre de waardes zijn van de forms
                       
if ($sqlbands) {
    $sqlbands->bind_param("ss", $name, $genre);
    $sqlbands->execute();
    $sqlbands->close(); 
    echo "Band Added!  ";

    //als de connectie fucked is krijg je een error code die uitlegt wat er fout gaat
                       
} else {
    echo "Error: " . $conn->error;
}
//als de genres wel '' is dan geeft ie dit aan en voert hij de connectie niet uit.
}else {
    echo " <br> Minimaal 1 Genre invullen";
} 
?>


