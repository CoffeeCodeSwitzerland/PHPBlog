<?php
  session_start();
  require_once("include/functions.php");
  require_once("include/functions_db.php");
  require_once("include/functions_db_plus.php");
  define("DBNAME", "db/blog.db");
  // Datenbankverbindung herstellen, diesen Teil nicht ändern!
  if (!file_exists(DBNAME)) exit("Die Datenbank 'blog.db' konnte nicht gefunden werden!");
  $db = new SQLite3(DBNAME);
  setValue("cfg_db", $db);
  // Einfacher Dispatcher: Aufruf der Funktionen via index.php?function=xy
  if (isset($_GET['function'])) $function = $_GET['function'];
  else $function = "login";
  // Prüfung, ob bereits ein Blog ausgewählt worden ist
  if (isset($_GET['bid'])) $blogId = $_GET['bid'];
  else $blogId = 0;
  // Prüfung, ob bereits ein Eintrag ausgewählt worden ist
  if (isset($_GET['eid'])) $entryId = $_GET['eid'];
  else $entryId = 0;

  if(isset($_GET['logout']) && $_GET['logout'] == true)
  {
    session_destroy();
    $url = $_SERVER['PHP_SELF']."?function=login";
    echo "<script>window.location = '$url'</script>";
  }
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="utf-8">
<!--
  Die nächsten 4 Zeilen sind Bootstrap, falls nicht gewünscht entfernen.
-->
  <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
  <link href="css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

  <script src="js/jquery-3.1.1.min.js"></script>
  <!--<script src="js/bootstrap.min.js"></script>-->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  <script src="include/functions.js"></script>
  <title>Blog-Projekt</title>
</head>

<body>
<!--
  nav, div und ul class="..." ist Bootstrap, falls nicht gewünscht entfernen oder anpassen.
  Die Einteilung der Website in verschiedene Bereiche (Menü-, Content-Bereich, usw.) kann auch selber mit div realisiert werden.
-->
<!--  <nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
      <div class="navbar-header">
		<a class="navbar-brand"><?php echo "Blog (Namen einsetzen...)"; ?></a>
      </div>
      <ul class="nav navbar-nav">
		<?php
		  echo "<li><a href='index.php?function=login&bid=$blogId'>Login</a></li>";
		  echo "<li><a href='index.php?function=blogs&bid=$blogId'>Blog wählen</a></li>";
		  echo "<li><a href='index.php?function=entries_login&bid=$blogId'>Beiträge anzeigen</a></li>";
		?>
      </ul>
	</div>
</nav>-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <h1>Blog von <?php echo getUserName($blogId); ?></h1>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <?php
      if(getUserIdFromSession() != 0)
      {
        echo "<a class='nav-item nav-link active'href='index.php?function=entries_public&bid=".getUserIdFromSession('uid')."'>Beiträge anzeigen</a>";
  		  echo "<a class='nav-item nav-link active'href='index.php?function=entries_public&bid=".getUserIdFromSession('uid')."'>Beiträge hinzufügen</a>";
        echo "<a class='nav-item nav-link active' href='index.php?function=login&bid=".getUserIdFromSession('uid')."&logout=true'>Logout</a>";
      } else {
  		  echo "<a class='nav-item nav-link active' href='index.php?function=login&bid=$blogId'>Login</a>";
  		  echo "<a class='nav-item nav-link active'href='index.php?function=blogs&bid=$blogId'>Blog wählen</a>";
  		  echo "<a class='nav-item nav-link active'href='index.php?function=entries_public&bid=$blogId'>Beiträge anzeigen</a>";
      }
  		?>
    </div>
  </div>
</nav>
  <?php
    // Für jede Funktion, die mit ?function=xy in der URL übergeben wird, muss eine Datei (in diesem Fall xy.php) existieren.
	// Diese Datei wird aufgerufen, um den Content der Seite aufzubereiten und anzuzeigen.
	if (!file_exists("$function.php")) exit("Die Datei '$function.php' konnte nicht gefunden werden!");
	require_once("$function.php");
  ?>
  </div>
</body>
</html>
<?php
  // Datenbankverbindung schliessen, diesen Teil nicht ändern!
  $db = getValue('cfg_db');
  $db->close();
?>
