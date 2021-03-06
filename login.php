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
      $user = getUserByEmail($email);
      if($user['role'] == 2) {
          $url = $_SERVER['PHP_SELF'] . "?function=admin_blogs&bid=1";
          echo "<script>window.location = '$url'</script>";
      } else {
          $url = $_SERVER['PHP_SELF'] . "?function=entries_member&bid=" . $uid;
          echo "<script>window.location = '$url'</script>";
      }
  } else {
    if( !empty($_POST) ) {
      echo "<h1 style='color:red;'>Fehler!</h1><br>";
    }
  }

  /*if(userExists($email))
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
<div class='container'>
  <h2>Bitte melden sie sich an</h2>
<form method='POST'>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="email" style="width:40%" aria-describedby="emailHelp" name="email" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="passwort" style="width:40%" name="passwort" placeholder="Password">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
