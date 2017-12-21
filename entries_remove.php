<?php
  if(getUserIdFromSession() != 0)
  {
    if(getEntry($_GET['eid']) != "")
    {
        deleteEntry($_GET['eid']);
        $url = $_SERVER['PHP_SELF'].'?function=entries_member';
        echo "<script>window.location = '$url'</script>";
    } else {
      echo "<h1 style='color:red;'>Fehler!\n Dieser Beitrag existiert nicht.</h1><br>";
    }
  }
?>
