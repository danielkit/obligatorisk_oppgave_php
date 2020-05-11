<?php

session_start();
@$innloggetBruker=$_SESSION["brukernavn"];

  if (!$innloggetBruker) {
	  print("Denne siden krever innlogging<br>");
  }

  else {
    include("start.html");
?>

<script src="funksjoner.js"></script>

<h2>Slett student</h2><br>

<form method="post" action="" id="slettStudentSkjema" name="slettStudentSkjema" onSubmit="return bekreft()">
  Student <select name="brukernavn" id="brukernavn"> <?php include("dynamiske_funksjoner.php"); listeboksSlettStudent(); ?> </select>
<br><br><input type="submit" value="Slett student" name="slettStudentKnapp" id="slettStudentKnapp"/> </form>

<?php

if (isset($_POST ["slettStudentKnapp"])) {
  
  include("tilkobling_database.php");

  $brukernavn=$_POST["brukernavn"];

  $sqlSetning="DELETE FROM student WHERE brukernavn='$brukernavn';";
  mysqli_query($db,$sqlSetning) or die ("ikke mulig å slette data i databasen");

  print ("Følgende student er nå slettet: $brukernavn.");
}

  include("slutt.html");
}

?>
