<?php
session_start();
@$innloggetBruker=$_SESSION["brukernavn"];

  if (!$innloggetBruker)
  {
    print("Denne siden krever innlogging<br>");
  }

  else
  {
?>

<!DOCTYPE html>
<html>
  <head>
    <script src="innlevering1.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>Innlevering 2</title>
    <link rel="stylesheet" type="text/css" href="innlevering1.css">
  </head>

  <body>

    <h1>Innlevering 2</h1>

    <nav>
      <a href="main_page.php">Hjem</a><br>
      <a href="sok.php">Søk i databasen</a><br>
      <br>
      <p><strong>Klasse</strong></p>
      <br>
      <a href="registrer_klasse.php">Registrer klasse</a><br>
      <a href="endre_klasse.php">Endre klasse</a><br>
      <a href="vis_klasse.php">Vis alle klasser</a><br>
      <a href="slett_klasse.php">Slett klasse</a><br>
      <br>
      <p><strong>Student</strong></p>
      <br>
      <a href="registrer_student.php">Registrer student</a><br>
      <a href="endre_student.php">Endre student</a><br>
      <a href="vis_studenter.php">Vis alle studenter</a><br>
      <a href="slett_student.php">Slett student</a><br>
      <br>
      <p><strong>Bilde</strong></p><br>
      <a href="registrer_bilde.php">Registrer bilde</a><br>
      <a href="vis_alle_bilder.php">Vis alle bilder</a><br>
      <a href="endre_beskrivelse_av_bilde.php">Endre beskrivelse av bilde</a><br>
      <a href="slett_bilde_ny.php">Slett bilde</a><br>
	  <a href="vis_klasseliste.php">Vis klasseliste</a><br><br>
      <a href="utlogging.php">Logg ut</a><br>
    </nav>

    <article>
      <h2 style="color: black;">Velkommen til startsiden</h2><br>
      <p style="font-size: 1.5em;">Bruk menyen til venstre for å navigere på applikasjonen.</p>
    </article>

  </body>
</html>
<?php } ?>
