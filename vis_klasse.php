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

<?php include("tilkobling_database.php"); ?>

<?php

$sqlSetning="SELECT * FROM klasse ORDER BY klassekode;";
$sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig å hente data fra databasen");
$antallRader=mysqli_num_rows($sqlResultat);

print ("<h2>Liste over registrerte klasser:</h2><br>");
print ("<table border=1>");
print ("<tr><th align=left>Klassekode</th><th align=left>Klassenavn</th></tr>");

for ($r=1;$r<=$antallRader;$r++)
{
  $rad=mysqli_fetch_array ($sqlResultat);
  $klassekode=$rad["klassekode"];
  $klassenavn=$rad["klassenavn"];

  print ("<tr><td>$klassekode</td><td>$klassenavn</td></tr>");
}

print ("</table>");

include("slutt.html");

}

?>
