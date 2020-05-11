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

	<form action="" method="post" name="VisKlasselisteSkjema" id="VisKlasselisteSkjema">
		Velg klasse <select name='klassekode' id='klassekode'><br><?php include("dynamiske_funksjoner.php"); listeboksVisKlasseliste($klassekode);?></select>
		<input type='submit' name='visKlasselisteKnapp' id='visKlasselisteKnapp' value='Velg klasse'>
	</form>

	<?php

	if(isset($_POST["visKlasselisteKnapp"]))
	{

		$klassekode=$_POST["klassekode"];

		print ("<br><br><h3>Klasseliste for $klassekode:</h3>");
		$sqlSetning="SELECT student.etternavn, student.fornavn, student.brukernavn, bildeprg.filnavn FROM student LEFT JOIN bildeprg ON student.bildenr=bildeprg.bildenr WHERE klassekode LIKE '%$klassekode%' ORDER BY student.etternavn;";
		$sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig å hente data fra databasen");
		$antallRader=mysqli_num_rows($sqlResultat);

		print ("<table border=1>");
		print ("<tr><td>Fornavn</td><td>Etternavn</td><td>Brukernavn</td><td>Bilde</td></tr>");

		for ($r=1;$r<=$antallRader;$r++)
		{
			$rad=mysqli_fetch_array($sqlResultat);
			$fornavn=$rad["fornavn"];
			$etternavn=$rad["etternavn"];
			$brukernavn=$rad["brukernavn"];
			$filnavn=$rad["filnavn"];

		print ("<tr><td>$fornavn</td><td>$etternavn</td><td>$brukernavn</td><td><img src='../../bilder/$filnavn'></a></td></tr>");

		}

		print ("</table>");

	}

	include("slutt.html");

}

?>
