<?php

function listeboksSlettStudent() {
	
    include("tilkobling_database.php");

    $sqlSetning="SELECT * FROM student ORDER BY klassekode;";
    $sqlResultat=mysqli_query($db,$sqlSetning) or die ("Ikke mulig å hente data fra databasen");
    $antallRader=mysqli_num_rows($sqlResultat);

    for ($r=1;$r<=$antallRader;$r++) {
		
        $rad=mysqli_fetch_array($sqlResultat);
        
		$brukernavn=$rad["brukernavn"];
        $fornavn=$rad["fornavn"];
        $etternavn=$rad["etternavn"];

        print("<option value='$brukernavn'>$brukernavn</option>");
        
		}

      }

?>

<?php

function listeboksSlettKlasse()

{
    include("tilkobling_database.php");

    $sqlSetning="SELECT * FROM klasse ORDER BY klassekode;";
    $sqlResultat=mysqli_query($db,$sqlSetning) or die ("Ikke mulig å hente data fra databasen");
    $antallRader=mysqli_num_rows($sqlResultat);

    for ($r=1;$r<=$antallRader;$r++)
      {
        $rad=mysqli_fetch_array($sqlResultat);
        $klassekode=$rad["klassekode"];

        print("<option value='$klassekode'>$klassekode</option>");
        }

      }

?>

<?php

function listeboksRegistrerStudent()

{
    include("tilkobling_database.php");

    $sqlSetning="SELECT * FROM klasse ORDER BY klassekode;";
    $sqlResultat=mysqli_query($db,$sqlSetning) or die ("Ikke mulig å hente data fra databasen");
    $antallRader=mysqli_num_rows($sqlResultat);

    for ($r=1;$r<=$antallRader;$r++)
      {
        $rad=mysqli_fetch_array($sqlResultat);
        $klassekode=$rad["klassekode"];

        print("<option value='$klassekode'>$klassekode</option>");
        }

      }

?>

<?php

function listeboksBrukernavn()

{
    include("tilkobling_database.php");

    $sqlSetning="SELECT * FROM student ORDER BY klassekode;";
    $sqlResultat=mysqli_query($db,$sqlSetning) or die ("Ikke mulig å hente data fra databasen");
    $antallRader=mysqli_num_rows($sqlResultat);

    for ($r=1;$r<=$antallRader;$r++)
      {
        $rad=mysqli_fetch_array($sqlResultat);
        $brukernavn=$rad["brukernavn"];

        print("<option value='$brukernavn'>$brukernavn</option>");
      }

}

?>

<?php

function listeboksEndreStudent()

{
    include("tilkobling_database.php");

    $brukernavn = $_POST["brukernavn"];

    $sqlSetning="SELECT * FROM klasse ORDER BY (klassekode = (SELECT klassekode FROM student WHERE brukernavn='$brukernavn')) DESC, 'klassekode';";
    $sqlResultat=mysqli_query($db,$sqlSetning) or die ("Ikke mulig å hente data fra databasen");
    $antallRader=mysqli_num_rows($sqlResultat);

    for ($r=1;$r<=$antallRader;$r++)
      {
        $rad=mysqli_fetch_array($sqlResultat);
        $klassekode=$rad["klassekode"];
        $brukernavn=$rad["brukernavn"];
        $fornavn=$rad["fornavn"];
        $etternavn=$rad["etternavn"];

        print("<option value='$klassekode'>$klassekode</option>");
      }
}

?>

<?php

function listeboksKlassekode()

{
    include("tilkobling_database.php");

    $sqlSetning="SELECT * FROM klasse ORDER BY klassekode;";
    $sqlResultat=mysqli_query($db,$sqlSetning) or die ("Ikke mulig å hente data fra databasen");
    $antallRader=mysqli_num_rows($sqlResultat);

    for ($r=1;$r<=$antallRader;$r++)
      {
        $rad=mysqli_fetch_array($sqlResultat);
        $klassekode=$rad["klassekode"];

        print("<option value='$klassekode'>$klassekode</option>");
      }

}

?>

<?php

function listeboksEndreBildenr()

{
    include("tilkobling_database.php");

    $sqlSetning="SELECT bildenr FROM bildeprg;";
    $sqlResultat=mysqli_query($db,$sqlSetning) or die ("Ikke mulig å hente data fra databasen");
    $antallRader=mysqli_num_rows($sqlResultat);

    for ($r=1;$r<=$antallRader;$r++)
      {
        $rad=mysqli_fetch_array($sqlResultat);
        $bildenr=$rad["bildenr"];
		$brukernavn=$rad["brukernavn"];

        print("<option value='$bildenr'>$bildenr</option>");
      }

}

?>

<?php

function listeboksBildenr()

{
    include("tilkobling_database.php");

    $bildenr=$_POST["bildenr"];

    $sqlSetning="SELECT bildenr FROM bildeprg;";
    $sqlResultat=mysqli_query($db,$sqlSetning) or die ("Ikke mulig å hente data fra databasen");
    $antallRader=mysqli_num_rows($sqlResultat);

    for ($r=1;$r<=$antallRader;$r++)
      {
        $rad=mysqli_fetch_array($sqlResultat);
        $bildenr=$rad["bildenr"];
        $filnavn=$rad["filnavn"];
        $beskrivelse=$rad["beskrivelse"];
        $opplastingsdato=$rad["opplastingsdato"];


        print("<option value='$bildenr'>$bildenr</option>");
      }

}

?>

<?php

function listeboksSlettBilde()

{
    include("tilkobling_database.php");

    $sqlSetning="SELECT * FROM bildeprg ORDER BY bildenr;";
    $sqlResultat=mysqli_query($db,$sqlSetning) or die ("Ikke mulig å hente data fra databasen");
    $antallRader=mysqli_num_rows($sqlResultat);

    for ($r=1;$r<=$antallRader;$r++)
      {
        $rad=mysqli_fetch_array($sqlResultat);
        $bildenr=$rad["bildenr"];
        $filnavn=$rad["filnavn"];
        $beskrivelse=$rad["beskrivelse"];
        $opplastingsdato=$rad["opplastingsdato"];

        print("<option value='$bildenr'>$bildenr</option>");
      }
  }

?>

<?php

function listeboksFilnavn()

{
    include("tilkobling_database.php");

    $filnavn=$_POST["filnavn"];

    $sqlSetning="SELECT filnavn FROM bildeprg;";
    $sqlResultat=mysqli_query($db,$sqlSetning) or die ("Ikke mulig å hente data fra databasen");
    $antallRader=mysqli_num_rows($sqlResultat);

    for ($r=1;$r<=$antallRader;$r++)
      {
        $rad=mysqli_fetch_array($sqlResultat);
        $bildenr=$rad["bildenr"];
        $filnavn=$rad["filnavn"];
        $beskrivelse=$rad["beskrivelse"];
        $opplastingsdato=$rad["opplastingsdato"];

        print("<option value='$filnavn'>$filnavn</option>");
      }

}

?>

<?php

function listeboksVisKlasseliste()

{
    include("tilkobling_database.php");

    $sqlSetning="SELECT * FROM klasse;";
    $sqlResultat=mysqli_query($db,$sqlSetning) or die ("Ikke mulig å hente data fra databasen");
    $antallRader=mysqli_num_rows($sqlResultat);

    for ($r=1;$r<=$antallRader;$r++)
      {
        $rad=mysqli_fetch_array($sqlResultat);
        $klassekode=$rad["klassekode"];

        print("<option value='$klassekode'>$klassekode</option>");
      }

}

?>