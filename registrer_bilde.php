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

<h2>Registrer bilde</h2><br>

<form method="post" action="" enctype="multipart/form-data" id="registrerBildeSkjema" name="registrerBildeSkjema">
  Filnavn: <input type="text" id="filnavn" name="filnavn" required/><br>
  Beskrivelse: <input type="text" id="beskrivelse" name="beskrivelse" required/><br>
  Bildenummer: <input type="text" id="bildenr" name="bildenr" required/><br><br>
  Bilde <input type="file" id="file" name="file" size="60"/><br><br>
  <input type="submit" value="Registrer bilde" id="registrerBildeKnapp" name="registrerBildeKnapp"/>
  <input type="reset" value="Nullstill" id="nullstill" name="nullstill"/>
</form>

<?php

if (isset($_POST["registrerBildeKnapp"]))
{

  $filnavn=$_POST ["filnavn"];
  $beskrivelse=$_POST ["beskrivelse"];
  $bildenr=$_POST ["bildenr"];

  $filnavn=$_FILES ["file"]["name"];      /* sjekker filnavn på opplastet fil */
  $filtype=$_FILES ["file"]["type"];      /* sjekker filtypen på opplastet fil */
  $filstorrelse=$_FILES ["file"]["size"]; /* sjekker størrelsen på opplastet fil */
  $tmpnavn=$_FILES ["file"]["tmp_name"];  /* midlertidlig filnavn på opplastet fil */
  $nyttnavn="../../bilder/".$filnavn;

  if (!$filnavn || !$beskrivelse)
  {
    print ("Begge feltene må fylles ut.");
  }

  else
  {

  if ($filtype !="image/gif" && $filtype !="image/jpeg" && $filtype !="image/png")
  {
    print ("<br>Filen må være et bilde.");
  }

  else if ($filstorrelse > 5000000)
  {
    print ("Bildet er for stort. Bildet må være under 5MB.");
  }

  else
  {
    include("tilkobling_database.php");
    $sqlSetning="SELECT * FROM bildeprg WHERE bildenr='$bildenr';";
    $sqlResultat=mysqli_query($db,$sqlSetning) or die ("Ikke kontakt med databasen.");
    $antallRader=mysqli_num_rows($sqlResultat);

  if ($antallRader!=0)
  {
    print ("Bildenummeret er allerede registrert.");
  }

  else
  {
    include("tilkobling_database.php");
    move_uploaded_file($tmpnavn,$nyttnavn) or die ("Ikke mulig å registrere bildet.");
    $sqlSetning="INSERT INTO bildeprg (filnavn,beskrivelse, bildenr) VALUES ('$filnavn','$beskrivelse','$bildenr');";
    mysqli_query($db,$sqlSetning) or die ("<br>Ikke mulig å registrere bildet i databasen.");
    print ("<br>Suksess. Bildet er lastet opp.");
    print("<br><br><a href='$nyttnavn'>$filnavn</a>");
   }
  }
 }
}
}

include("slutt.html");

?>
