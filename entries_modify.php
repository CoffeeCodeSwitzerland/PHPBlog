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

  if(isset($_GET['eid']) && in_array(getEntry($_GET['eid']),getEntries(getUserIdFromSession())))
  {
    //echo "<scipt>alert('".in_array($_GET['eid'],getEntries(getUserIdFromSession())[2])."')</script>";
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
      echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#myModal'>Entfernen</button>";
      echo "<button onclick='location.href=\"".$_SERVER['PHP_SELF']."?function=entries_member\"' class='btn btn-primary'>Abbrechen</button>";
      echo "<!-- Modal -->
            <div class='modal fade' id='myModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
              <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                  <div class='modal-header'>
                    <h5 class='modal-title' id='exampleModalLabel'>Entfernen bestätigen</h5>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                      <span aria-hidden='true'>&times;</span>
                    </button>
                  </div>
                  <div class='modal-body'>
                    Wollen Sie den Eintrag wirklich entfernen?
                  </div>
                  <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Abbrechen</button>
                    <button onclick='location.href=\"".$_SERVER['PHP_SELF']."?function=entries_remove&eid=".$eid."\"' class='btn btn-primary'>Entfernen</button>
                  </div>
                </div>
              </div>
            </div>";
      echo "</div>";
    } else {
      echo "<h1 style='color:red;'>Fehler!\n Dieser Beitrag existiert nicht.</h1><br>";
    }
  } else {
    echo "<h1 style='color:red;'>Fehler!\n Dieser Beitrag existiert nicht oder du hast nicht die Berechtigung ihn zu bearbeiten.</h1><br>";
  }
}

?>
