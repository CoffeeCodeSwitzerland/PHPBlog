<?php
// $_SERVER['PHP_SELF'] = login.php in diesem Fall (also die PHP-Datei, die gerade ausgeführt wird).
// Mit andern Worten: Nach Senden des Formulars wird wieder login.php aufgerufen.
// Die Funktionen zur Überprüfung, ob die Login-Daten gültig sind, muss also hier oben im PHP-Teil stehen!
// Wenn Login-Daten korrekt sind:
// Session-Variable mit Benutzer-ID setzen und Wechsel in Memberbereich
// $_SESSION['uid'] = $uid;
// header('Location: index.php?function=entries_member');
// Wenn Formular gesendet worden ist, die Login-Daten aber nicht korrekt sind:
// Unten auf der Seite Anzeige der Fehlermeldung.

  $email = "";
  $passwort = "";
  $user = [];

  if(isset($_POST['passwort'])) $passwort = $_POST['passwort'];
  if(isset($_POST['email'])) $email = $_POST['email'];

  $uid = getUserIdFromDb($email,$passwort);

  if($uid > 0)
  {
    $_SESSION['uid'] = $uid;
  }

  if($uid > 0)
  {
    $url = $_SERVER['PHP_SELF']."?function=entries_member&bid=".$uid;
    echo "<script>window.location = '$url'</script>";
  } else {
    if( !empty($_POST) ) {
      echo "<h1 style='color:red;'>Fehler!</h1><br>";
    }
  }

  /*
  if(userExists($email))
  {
    $user = getUserByEmail($email);
    if($user['password'] == $passwort)
    {
      $_SESSION['uid'] = $user['uid'];
      $meldung = "Wilkommen";
    }
    else {
      $meldung = "Fehler";
    }
  }*/
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']."?function=login"; ?>">
  <label for="email">Benutzername</label>
  <div>
	<input type="email" id="email" name="email" placeholder="E-Mail" value="" />
  </div>
  <label for="passwort">Passwort</label>
  <div>
	<input type="password" id="passwort" name="passwort" placeholder="Passwort" value="" />
  </div>
  <div>
	<button type="submit">senden</button>
  </div>
</form>
