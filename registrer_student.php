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

    <h2>Registrer student</h2><br>
    <script src="innlevering1.js"> </script>

    <form method="post" action="" name="student" id="student" onsubmit="return validerStudent_Data()">
      Brukernavn: <input type="text" name="brukernavn" id="brukernavn" onFocus="fokus(this)" onBlur="mistetFokus(this)" onMouseover="musInn(this)" onMouseout="musUt()" onClick='settFokus(document.getElementById("brukernavn"))' onKeyUp="capsLock(this)" required ><br>
      Fornavn: <input type="text" name="fornavn" id="fornavn" onFocus="fokus(this)" onBlur="mistetFokus(this)" onMouseover="musInn(this)" onMouseout="musUt()" onClick='settFokus(document.getElementById("fornavn"))' required ><br>
      Etternavn: <input type="text" name="etternavn" id="etternavn" onFocus="fokus(this)" onBlur="mistetFokus(this)" onMouseover="musInn(this)" onMouseout="musUt()" onClick='settFokus(document.getElementById("etternavn"))' required ><br>
      Klassekode: <select name="klassekode" id="klassekode"> <?php include("dynamiske_funksjoner.php"); listeboksRegistrerStudent(); ?> </select onFocus="fokus(this)" onBlur="mistetFokus(this)" onMouseover="musInn(this)" onMouseout="musUt()" onClick='settFokus(document.getElementById("klassekode"))'onKeyUp="vis(this.value); capsLock(this)" required ><br>
      Neste innleveringsfrist: <input type="date" name="neste_innleveringsfrist" id="neste_innleveringsfrist"><br>
      Bildenr: <select name="bildenr" id="bildenr"> <?php include("dynamiske_funksjoner.php"); listeboksBildenr(); ?> </select><br><br>
      <br><input type="submit" name="registrerStudentKnapp" value="Registrer">
      <input type="reset" name="nullstill" value="Nullstill" onClick="fjernMelding()">
      <br>
    </form>

    <div id="melding"> </div>
    <div id="studenter"> </div>
    <div id="feilmelding"> </div>

<?php

if (isset($_POST ["registrerStudentKnapp"]))

{
  $brukernavn=$_POST ["brukernavn"];
  $fornavn=$_POST ["fornavn"];
  $etternavn=$_POST ["etternavn"];
  $klassekode=$_POST ["klassekode"];
  $neste_innleveringsfrist=$_POST ["neste_innleveringsfrist"];
  $bildenr=$_POST ["bildenr"];

    if (!$brukernavn || !$fornavn || !$etternavn || !$klassekode || !$neste_innleveringsfrist || !$bildenr)
      {
        print ("Alle feltene må fylles ut");
      }

    else
    {
      include("validering.php");
      $lovligStudentData=validerStudentData($brukernavn);

      if (!$lovligStudentData)
        {
          print ("Student-data er ikke fylt ut korrekt.");
        }

    else
    {
      include("tilkobling_database.php");

      $sqlSetning="SELECT * FROM student WHERE brukernavn='$brukernavn';";
      $sqlResultat=mysqli_query($db,$sqlSetning) or die ("Ikke mulig å hente data fra databasen");
      $antallRader=mysqli_num_rows($sqlResultat);

      if ($antallRader!=0)
      {
        print ("Studenten er allerede registrert");
      }

        else
        {
          $sqlSetning="INSERT INTO student (brukernavn, fornavn, etternavn, klassekode, neste_innleveringsfrist, bildenr) VALUES ('$brukernavn','$fornavn','$etternavn','$klassekode','$neste_innleveringsfrist','$bildenr');";
          mysqli_query($db,$sqlSetning) or die ("Ikke mulig å registrere data i databasen");
          print ("<br><br>Følgende student er nå registrert: $brukernavn <br> $fornavn $etternavn <br> $klassekode <br> $neste_innleveringsfrist <br> Bildenummer: $bildenr");
        }
      }
    }
  }
}

include("slutt.html");

?>
