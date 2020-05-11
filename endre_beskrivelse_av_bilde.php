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

<h2>Endre beskrivelse av bilde</h2><br>

  <form method="post" action="" id="endreBAB" name="endreBAB">
    Bilde: <select id="bildenr" name="bildenr"> <?php include("dynamiske_funksjoner.php"); listeboksBildenr(); ?> </select><br><br>
    <input type="submit" value="Velg bilde" id="velgBildeKnapp" name="velgBildeKnapp">
  </form>

<div id="melding"> </div>

<?php


  if(isset($_POST["velgBildeKnapp"]))
  {

    include("tilkobling_database.php");

    $bildenr=$_POST["bildenr"];

    $sqlSetning = "SELECT * FROM bildeprg WHERE bildenr = '$bildenr';";
    $sqlResultat=mysqli_query($db,$sqlSetning) or die ("Ingen tilkobling til databasen.");
    $antallRader=mysqli_num_rows($sqlResultat);

    $rad = mysqli_fetch_array($sqlResultat);
    $bildenr=$rad["bildenr"];
    $beskrivelse=$rad["beskrivelse"];

    print ("<br>");
    print ("<form method='post' action='' id='endreBeskrivelseSkjema' name='endreBeskrivelseSkjema'>");
    print ("Bildenr <input type='text' value='$bildenr' name='bildenr' id='bildenr' readonly><br>");
    print ("Beskrivelse <input type='text' value='$beskrivelse' name='endreBeskrivelse' id='endreBeskrivelse' required><br>");
    print ("<br><input type='submit' value='Endre beskrivelse' name='endreBeskrivelseKnapp' id='endreBeskrivelseKnapp'>");
    print ("</form>");
  }

  if (isset($_POST["endreBeskrivelseKnapp"]))
  {
    $beskrivelse=$_POST["endreBeskrivelse"];
    $bildenr=$_POST["bildenr"];

    if (!$beskrivelse)
    {
      print ("Feltet må fylles ut.");
    }

    else
    {
      include("tilkobling_database.php");
      $bildenr=$_POST["bildenr"];
      $sqlSetning = "UPDATE bildeprg SET beskrivelse = '$beskrivelse' WHERE bildenr = '$bildenr';";
      mysqli_query($db,$sqlSetning) or die ("Ikke mulig å endre data i databasen");
      print("Sukess. Beskrivelsen er nå endret.");
    }
  }

  include("slutt.html");
}
?>
