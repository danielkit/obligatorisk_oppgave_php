<?php
session_start();
@$innloggetBruker=$_SESSION["brukernavn"];

  if (!$innloggetBruker)
  {
    print("Denne siden krever innlogging<br>");
  }

  else
  {
    include("start.html");
?>

<script src="funksjoner.js"></script>

<h2>Slett klasse</h2><br>

<form method="post" action="" id="slettKlasseSkjema" name="slettKlasseSkjema" onSubmit="return bekreft()">
  Klasse <select name="klassekode" id="klassekode"> <?php include("dynamiske_funksjoner.php"); listeboksSlettKlasse(); ?> </select>
  <input type="submit" value="Slett klasse" name="slettKlasseKnapp" id="slettKlasseKnapp"/>
</form>

<?php

if (isset($_POST ["slettKlasseKnapp"]))
{
  include("tilkobling_database.php");

  $klassekode=$_POST["klassekode"];

  $sqlSetning="DELETE FROM klasse WHERE klassekode='$klassekode';";
  mysqli_query($db,$sqlSetning) or die ("ikke mulig å slette data i databasen");

  print ("Følgende klasse er nå slettet: $klassekode.");
}

  include("slutt.html");
}
?>
