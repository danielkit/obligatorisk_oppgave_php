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

  <script src="innlevering1.js"></script>

    <h2>Registrer klasse</h2><br>

    <form method="post" action="" name="klasse" id="klasse" onsubmit="return valider_Klasse_Kode()">
      Klassekode: <input type="text" name="klassekode" id="klassekode" onFocus="fokus(this)" onBlur="mistetFokus(this)" onMouseover="musInn(this)" onMouseout="musUt()" onClick='settFokus(document.getElementById("klassekode"))' onKeyUp="capsLock(this)" required ><br>
      Klassenavn: <input type="text" name="klassenavn" id="klassenavn" onFocus="fokus(this)" onBlur="mistetFokus(this)" onMouseover="musInn(this)" onMouseout="musUt()" onClick='settFokus(document.getElementById("klassenavn"))' required ><br><br>
      <input type="submit" name="registrerKlasseKnapp" value="Registrer">
      <input type="reset" name="nullstill" value="Nullstill"><br>
    </form><br>

    <div id="melding_registrer_klasse"></div>

    <?php

    if (isset($_POST ["registrerKlasseKnapp"]))

    {
      $klassekode=$_POST ["klassekode"];
      $klassenavn=$_POST ["klassenavn"];
      $klassekode=strtoupper($klassekode);

      if (!$klassekode || !$klassenavn)
        {
          print ("Begge feltene må fylles ut");
        }

        else
        {
          include("validering.php");
          $lovligKlassekode=validerKlassekode($klassekode);

          if (!$lovligKlassekode)
            {
              print ("Klassekoden er ikke fylt ut korrekt.");
            }

            else
            {
              include("tilkobling_database.php");
              $sqlSetning="SELECT * FROM klasse WHERE klassekode='$klassekode';";
              $sqlResultat=mysqli_query($db,$sqlSetning) or die ("Ikke mulig å hente data fra databasen");
              $antallRader=mysqli_num_rows($sqlResultat);

              if ($antallRader!=0)
              {
                print ("Klassen er allerede registrert");
              }

            else
            {
              $sqlSetning="INSERT INTO klasse (klassekode, klassenavn) VALUES ('$klassekode','$klassenavn');";
              mysqli_query($db,$sqlSetning) or die ("Ikke mulig å registrere data i databasen");
              print ("Følgende klasse er nå registrert: $klassekode $klassenavn");
            }
          }
        }
      }
    }
    include("slutt.html");

    ?>
