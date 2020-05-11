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

<script src="funksjoner.js"> </script>

<h2>Slett bilde</h2><br>

<form method="post" action="" name="slettBildeSkjema" id="slettBildeSkjema" onSubmit="return bekreft()">
  Bilde <select name="bildenr" id="bildenr"> <?php include("dynamiske_funksjoner.php");listeboksSlettBilde();?></select>
  <input type="submit" name="slettBildeKnapp" value="Slett bilde" id="slettBildeKnapp">
</form>

<div name="melding" id="melding"></div><br>

<?php

  if (isset($_POST["slettBildeKnapp"]))
  {
    $bildenr=$_POST["bildenr"];
    include("tilkobling_database.php");

    $SQLSelect="SELECT filnavn FROM bildeprg where bildenr='$bildenr';";
    $SQLQueryResult=mysqli_query($db,$SQLSelect) or die ("Ikke mulig å hente fra database.");
    $rad=mysqli_fetch_array($SQLQueryResult);
    $filnavn=$rad["filnavn"];

    $SQLSelect="SELECT beskrivelse FROM bildeprg where bildenr='$bildenr';";
    $SQLQueryResult=mysqli_query($db,$SQLSelect) or die ("Ikke mulig å hente fra database.");
    $rad=mysqli_fetch_array($SQLQueryResult);
    $beskrivelse=$rad["beskrivelse"];

    $SQLSelect="DELETE FROM bildeprg WHERE bildenr='$bildenr';";
    mysqli_query($db,$SQLSelect) or die ("Det er ikke mulig å slette et bilde som er tilknyttet en student.");

    print("Følgende bilde er slettet: <strong>$bildenr</strong>, <strong>$filnavn</strong>, <strong>$beskrivelse</strong>, fra databasen");

      $bildeFil="../../bilder/".$filnavn;

      unlink($bildeFil) or die ("Ikke mulig å slette fil fra server");

      print(" og fra serveren.");
  }
}
include("slutt.html");

?>
