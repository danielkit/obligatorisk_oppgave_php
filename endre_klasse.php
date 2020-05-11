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

<h2>Endre klasse</h2><br>

  <form method="post" action="" id="endreKlasse" name="endreKlasse">
    Klasse: <select id="klassekode" name="klassekode">
      <?php include("dynamiske_funksjoner.php"); listeboksKlassekode(); ?>
      </select><br><br>
    <input type="submit" value="Velg klasse" id="velgKlasseKnapp" name="velgKlasseKnapp">
  </form>

<div id="melding"> </div>

<?php
  if (isset($_POST["velgKlasseKnapp"])) {

    include("tilkobling_database.php");

    $klassekode=$_POST["klassekode"];

    $sqlSetning = "SELECT * FROM klasse WHERE klassekode = '$klassekode';";
    $sqlResultat=mysqli_query($db,$sqlSetning) or die ("Ingen tilkobling til databasen");
    $antallRader=mysqli_num_rows($sqlResultat);

    $rad = mysqli_fetch_array($sqlResultat);
    $klassekode=$rad["klassekode"];
    $klassenavn=$rad["klassenavn"];

    print ("<br>");
    print ("<form method='post' action='' id='endreKlasseSkjema' name='endreKlasseSkjema' onSubmit='return validerEndreKlasse()'>");
    print ("Klassekode <input type='text' value='$klassekode' name='endreKlassekode' id='endreKlassekode' readonly><br>");
    print ("Klassenavn <input type='text' value='$klassenavn' name='endreKlassenavn' id='endreKlassenavn' required ><br>");
    print ("<br><input type='submit' value='Endre klassenavn' name='endreKlasseKnapp' id='endreKlasseKnapp'>");
    print ("</form>");
  }

  if (isset($_POST["endreKlasseKnapp"]))
  {
    $klassekode=$_POST["endreKlassekode"];
    $klassenavn=$_POST["endreKlassenavn"];
    $klassekode=strtoupper($klassekode);

    if (!$klassekode || !$klassenavn)
    {
      print("Begge feltene må fylles ut.");
    }

    else
    {
      include("tilkobling_database.php");
      $sqlSetning = "UPDATE klasse SET klassenavn = '$klassenavn' WHERE klassekode = '$klassekode';";
      mysqli_query($db,$sqlSetning) or die ("Ikke mulig å endre data i databasen");
      print("Klassenavnet er nå endret til: <br> $klassenavn.");
    }
  }
  include("slutt.html");
}

?>
