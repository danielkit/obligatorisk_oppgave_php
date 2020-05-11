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

<h2>Søk i databasen</h2><br>

<form method="post" action="" id="sokeSkjema" name="sokeSkjema">
    Søk: <input type="text" id="sokestreng" name="sokestreng" required /><br><br>
    <input type="submit" value="Søk" id="sokeKnapp" name="sokeKnapp"/>
    <input type="reset" value="Nullstill" id="nullstill" name="nullstill"/><br>
</form><br>

<?php

  if (isset($_POST ["sokeKnapp"]))
{

  $sokestreng=$_POST["sokestreng"];
  include("tilkobling_database.php");
  print ("Treff for søkestrengen <strong>$sokestreng</strong>:<br><br>");

  /* Søk i student-tabellen */
  $sqlSetning="SELECT * FROM student WHERE brukernavn LIKE '%$sokestreng%' OR fornavn LIKE '%$sokestreng%' OR etternavn LIKE '%$sokestreng%' OR klassekode LIKE '%$sokestreng%' ORDER BY klassekode;";
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("Ikke mulig å hente data fra databasen");
  $antallRader=mysqli_num_rows($sqlResultat);

  if($antallRader==0)
  {
    print ("Treff i <strong>student</strong>-tabellen: <strong>Ingen</strong><br>");
  }

  else
  {
    print ("Treff i <strong>student</strong>-tabellen:<br>");
    print ("<table border=1");
    print ("<tr><td><strong>Brukernavn</strong></td><td><strong>Fornavn</strong></td><td><strong>Etternavn</strong></td><td><strong>Klassekode</strong></td></tr>");

  for ($r=1;$r<=$antallRader;$r++)
    {
      $rad=mysqli_fetch_array($sqlResultat);
      $klassekode=$rad["klassekode"];
      $brukernavn=$rad["brukernavn"];
      $fornavn=$rad["fornavn"];
      $etternavn=$rad["etternavn"];
      print ("<tr><td>$brukernavn</td><td>$fornavn</td><td>$etternavn</td><td>$klassekode</td></tr>");
    }
  }
  print("</table><br>");
}


  if (isset($_POST ["sokeKnapp"]))
{

  $sokestreng=$_POST["sokestreng"];
  include("tilkobling_database.php");

  /* Søk i klasse-tabellen */
  $sqlSetning="SELECT * FROM klasse WHERE klassekode LIKE '%$sokestreng%' OR klassenavn LIKE '%$sokestreng%' ORDER BY klassekode;";
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("Ikke mulig å hente data fra databasen");
  $antallRader=mysqli_num_rows($sqlResultat);

  if($antallRader==0)
  {
    print ("Treff i <strong>klasse</strong>-tabellen: <strong>Ingen</strong><br>");
  }

  else
  {
    print ("Treff i <strong>klasse</strong>-tabellen:<br>");
    print ("<table border=1");
    print ("<tr><td><strong>Klassekode</strong></td><td><strong>Klassenavn</strong></td></tr>");

  for ($r=1;$r<=$antallRader;$r++)
    {
      $rad=mysqli_fetch_array($sqlResultat);
      $klassekode=$rad["klassekode"];
      $klassenavn=$rad["klassenavn"];
      print ("<tr><td>$klassekode</td><td>$klassenavn</td></tr>");
    }
  }
  print("</table>");
}
}
include("slutt.html");

?>
