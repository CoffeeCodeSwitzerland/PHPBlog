<?php

  if(getUserIdFromSession() != 0)
  {
    deleteEntry($_GET['eid']);
    $url = $_SERVER['PHP_SELF']."?function=entries_member";
    echo "<script>window.location = '$url'</script>";
  }

?>
