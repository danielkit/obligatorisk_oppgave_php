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

<?php include("tilkobling_database.php");

$sqlSetning="SELECT * FROM bildeprg;";
$sqlResultat=mysqli_query($db,$sqlSetning) or die ('Ikke kontakt med databasen');
$antallRader=mysqli_num_rows($sqlResultat);

print ("<h2>Liste over registrerte bilder</h2><br>");
print ("<table border=1>");
print ("<tr><th>Bildenummer</th><th>Opplastingsdato</th><th>Filnavn</th><th>Beskrivelse</th><tr>");

for ($r=1;$r<=$antallRader;$r++)
{
  $rad=mysqli_fetch_array($sqlResultat);
  $bildenr=$rad["bildenr"];
  $opplastingsdato=$rad["opplastingsdato"];
  $filnavn=$rad["filnavn"];
  $beskrivelse=$rad["beskrivelse"];

print ("<tr><td>$bildenr</td><td>$opplastingsdato</td><td>$filnavn</><td>$beskrivelse</td></tr>");
}

print ("</table>");

include("slutt.html");

}

?>
