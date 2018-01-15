<?php
  if(getUserIdFromSession() != 0)
  {
    if(getEntry($_GET['eid']) != "")
    {
        $url = $_SERVER['PHP_SELF'] . '?function=entries_member';
        if($_SESSION['isAdmin'] == "true") {
            $url = $_SERVER['PHP_SELF'] . '?function=admin_blogs&bid=' . $_GET['bid'];
            deleteEntry($_GET['eid']);
        } elseif (getUserIdFromSession() == $_GET['eid']){
            $url = $_SERVER['PHP_SELF'] . '?function=entries_member';
            deleteEntry($_GET['eid']);
        }
        echo "<script>window.location = '$url'</script>";
    } else {
      echo "<h1 style='color:red;'>Fehler!\n Dieser Beitrag existiert nicht.</h1><br>";
    }
  }
?>
