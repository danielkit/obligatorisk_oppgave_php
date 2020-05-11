<?php

function validerKlassekode($klassekode) {

  $lovligKlassekode=true;

  if (!$klassekode) {
    $lovligKlassekode=false;
  }

    else if (strlen($klassekode)<3) {
      $lovligKlassekode=false;
      print ("Klassekoden skal bestå av minst tre tegn.");
    }

    else {
        $tegn=str_split($klassekode);

        if (!is_numeric(end($tegn))) {
          $lovligKlassekode=false;
          print ("Det siste tegnet i klassekoden må være et siffer.");
        }
        
		else {
          return $lovligKlassekode;
        }
      }
    }

?>

<?php

function validerStudentData($brukernavn) {

$brukernavn=$_POST ["brukernavn"];
$fornavn=$_POST ["fornavn"];
$etternavn=$_POST ["etternavn"];
$klassekode=$_POST ["klassekode"];

$lovligStudentdata=true;

  if (!$brukernavn || !$fornavn || !$etternavn || !$klassekode) {
    $lovligStudentData=false;
  }

  if (is_numeric($brukernavn)) {
    print ("Brukernavn kan ikke inneholde tall.<br>");
    $lovligStudentData=false;
  }

  if (is_numeric($fornavn)) {
    print ("Fornavn kan ikke inneholde tall.<br>");
    $lovligStudentData=false;
  }

  if (is_numeric($etternavn)) {
    print ("Etternavn kan ikke inneholde tall.<br>");
    $lovligStudentData=false;
  }

    else if (strlen($brukernavn)<2) {
      $lovligStudentData=false;
      print ("Brukernavnet skal bestå av minst to tegn.<br>");
    }

    else {
      return $lovligStudentdata;
    }
}

?>


<?php

function validerStudentDataEndre($brukernavn) {

  $brukernavn=$_POST["endreBrukernavn"];
  $fornavn=$_POST["endreFornavn"];
  $etternavn=$_POST["endreEtternavn"];
  $klassekode=$_POST["endreKlassekode"];

  $lovligStudentdataEndre=true;

  if (!$brukernavn || !$fornavn || !$etternavn || !$klassekode) {
    $lovligStudentdataEndre=false;
  }

  if (is_numeric($brukernavn)) {
    print ("Brukernavn kan ikke inneholde tall.<br>");
    $lovligStudentdataEndre=false;
  }

  if (is_numeric($fornavn)) {
    print ("Fornavn kan ikke inneholde tall.<br>");
    $lovligStudentdataEndre=false;
  }

  if (is_numeric($etternavn)) {
    print ("Etternavn kan ikke inneholde tall.<br>");
    $lovligStudentdataEndre=false;
  }

    else if (strlen($brukernavn)<2) {
      $lovligStudentdataEndre=false;
      print ("Brukernavnet skal bestå av minst to tegn.<br>");
    }

    else {
      return $lovligStudentdataEndre;
    }
}

?>