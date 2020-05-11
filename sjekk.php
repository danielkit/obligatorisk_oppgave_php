<?php function sjekkBrukernavnPassord($brukernavn,$passord) {

include("tilkobling_database.php");

$lovligBruker=true;
$sqlSetning="SELECT * FROM bruker WHERE brukernavn='$brukernavn';";
$sqlResultat=mysqli_query($db,$sqlSetning);

if (!$sqlResultat) {
    $lovligBruker=false;
  }

  else {
    
	$rad=mysqli_fetch_array($sqlResultat);                                      /* ny rad hentet fra spørringsresultatet */
    $lagretBrukernavn=$rad["brukernavn"];
    $lagretPassord=$rad["passord"];                                             /* brukernavn og passord hentet fra databasen */

    if($brukernavn!=$lagretBrukernavn || $passord!=$lagretPassord) {
      $lovligBruker=false;
    
	}
  
  }
  
return $lovligBruker;

}

?>