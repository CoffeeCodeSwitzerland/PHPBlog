<?php

if(getUserIdFromSession() != 0)
{
  if(!empty($_POST))
  {
    if(strlen(trim($_POST['title'])) != 0 && strlen(trim($_POST['content']))!= 0)
    {
      updateEntry($_GET['eid'], $_POST['title'], $_POST['content']);
      $url = $_SERVER['PHP_SELF']."?function=entries_member";
      echo "<script>window.location = '$url'</script>";
    } else
    {
      echo "<h1 style='color:red;'>Fehler!\n Titel und/oder Inhalt ist leer.</h1><br>";
    }
  }

  if(isset($_GET['eid']))
  {
    $eid = $_GET['eid'];
    $entry = getEntry($eid);

    if($entry != "")
    {
    echo "<div class='container'>";
      echo "<form action='" . $_SERVER['PHP_SELF']. "?function=entries_modify&eid=".$eid."' method='POST'>";

      echo "<div class='form-group'>
        <label for='exampleInputEmail1'>Titel</label>
        <input style='padding-top:0.01%;padding-bottom:0.01%;' name='title' value=".$entry['title']." type='text' class='form-control' id='title' placeholder='Name des Beitrags'>
        </div>
        ";

      echo " <div class='form-group'>
        <label for='exampleFormControlTextarea1'>Beitrag</label>
        <textarea class='form-control' id='exampleFormControlTextarea1' name='content' rows='15'>".$entry['content']."</textarea>
      </div>";
      echo "<button type='submit' class='btn btn-primary'>Anpassen</button>";
      echo "</form>";
      echo "<button onclick='location.href=\"".$_SERVER['PHP_SELF']."?function=entries_remove&eid=".$eid."\"' class='btn btn-primary'>Entfernen</button>";
      echo "<button onclick='location.href=\"".$_SERVER['PHP_SELF']."?function=entries_member\"' class='btn btn-primary'>Abbrechen</button>";
      echo "</div>";
    } else {
      echo "<h1 style='color:red;'>Fehler!\n Dieser Beitrag existiert nicht.</h1><br>";
    }
  }
}

?>
