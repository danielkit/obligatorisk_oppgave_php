<?php

session_start();

@$innloggetBruker=$_SESSION["brukernavn"];

  if (!$innloggetBruker) {
    print("Denne siden krever innlogging<br>");
  }

  else {
    
	include("start.html");
	include("tilkobling_database.php");



$sqlSetning="SELECT * FROM student ORDER BY klassekode;";
$sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig å hente data fra databasen");
$antallRader=mysqli_num_rows($sqlResultat);

print ("<h2>Liste over registrerte studenter</h2><br>");
print ("<table border=1>");
print ("<tr><th align=left>Brukernavn</th><th align=left>Fornavn</th><th align=left>Etternavn</th><th align=left>Klassekode</th><th align=left>Neste innleveringsfrist</th><th align=left>Bildenr</th></tr>");

for ($r=1;$r<=$antallRader;$r++) {
  
  $rad=mysqli_fetch_array ($sqlResultat);
  $brukernavn=$rad["brukernavn"];
  $fornavn=$rad["fornavn"];
  $etternavn=$rad["etternavn"];
  $klassekode=$rad["klassekode"];
  $neste_innleveringsfrist=$rad["neste_innleveringsfrist"];
  $bildenr=$rad["bildenr"];

  print ("<tr><td>$brukernavn</td><td>$fornavn</td><td>$etternavn</td><td>$klassekode</td><td>$neste_innleveringsfrist</td><td>$bildenr</td></tr>");
}

print ("</table>");

include("slutt.html");

}

?>
