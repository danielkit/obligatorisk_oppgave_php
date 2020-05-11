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

<h2>Endre student</h2><br>
  <form method="post" action="" id="endreStudent" name="endreStudent">
    Brukernavn <select id="brukernavn" name="brukernavn"> <?php include("dynamiske_funksjoner.php"); listeboksBrukernavn(); ?> </select><br>
    <input type="submit" value="Velg student" id="velgStudentKnapp" name="velgStudentKnapp">
  </form>
  <br>
  <div id="melding"></div>

<?php

  if (isset($_POST["velgStudentKnapp"]))
  {

    include("tilkobling_database.php");

    $brukernavn=$_POST["brukernavn"];

    $sqlSetning = "SELECT * FROM student WHERE brukernavn = '$brukernavn';";
    $sqlResultat=mysqli_query($db,$sqlSetning) or die ("Ingen tilkobling til databasen");
    $antallRader=mysqli_num_rows($sqlResultat);

    $rad = mysqli_fetch_array($sqlResultat);
    $fornavn=$rad["fornavn"];
    $etternavn=$rad["etternavn"];
    $klassekode=$rad["klassekode"];
    $neste_innleveringsfrist=$rad["neste_innleveringsfrist"];
    $bildenr=$rad["bildenr"];

    print ("<br>");
    print ("<form method='post' action='' id='endreStudentSkjema' name='endreStudentSkjema' onSubmit='return valider_Endre_Student_Data()'>");
    print ("Brukernavn <input type='text' value='$brukernavn' name='endreBrukernavn' id='endreBrukernavn' readonly> <br>");
    print ("Fornavn <input type='text' value='$fornavn' name='endreFornavn' id='endreFornavn' required > <br>");
    print ("Etternavn <input type='text' value='$etternavn' name='endreEtternavn' id='endreEtternavn' required > <br>");
    print ("Klassekode <select id='endreKlassekode' name='endreKlassekode'>"); include('dynamiske_funksjoner.php'); listeboksEndreStudent($klassekode);
    print ("Neste innleveringsfrist <input type='date' value='$neste_innleveringsfrist' name='endreNesteInnleveringsfrist' id='endreNesteInnleveringsfrist' required > <br>");
    print ("Endre bildenummer <select id='endreBildenr' name='endreBildenr'>"); include('dynamiske_funksjoner.php'); listeboksEndreBildenr($bildenr);
	print ("<input type='submit' value='Endre student' name='endreStudentKnapp' id='endreStudentKnapp'>");
    print ("</form>");
  }


  if (isset($_POST["endreStudentKnapp"]))
  {
    $brukernavn=$_POST["endreBrukernavn"];
    $fornavn=$_POST["endreFornavn"];
    $etternavn=$_POST["endreEtternavn"];
    $klassekode=$_POST["endreKlassekode"];
    $neste_innleveringsfrist=$_POST["endreNesteInnleveringsfrist"];
    $bildenr=$_POST["endreBildenr"];

    if (!$fornavn || !$etternavn || !$klassekode || !$neste_innleveringsfrist || !$bildenr)
    {
      print("Alle feltene må fylles ut.");
    }

    else
    {
      include("validering.php");
      $lovligStudentDataEndre=validerStudentDataEndre($brukernavn);

      if (!$lovligStudentDataEndre)
        {
          print ("Student-data er ikke fylt ut korrekt.");
        }

    else
    {
      include("tilkobling_database.php");
      $sqlSetning = "UPDATE student SET fornavn = '$fornavn', etternavn = '$etternavn', klassekode = '$klassekode', neste_innleveringsfrist = '$neste_innleveringsfrist', bildenr = '$bildenr' WHERE brukernavn = '$brukernavn';";
      mysqli_query($db,$sqlSetning) or die ("Ikke mulig å endre data i databasen");
      print("Student-informasjonen er nå endret til: <br> $fornavn $etternavn <br> $klassekode <br> $neste_innleveringsfrist <br> $bildenr");
    }
   }
  }
}
  include("slutt.html");
?>
