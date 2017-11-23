<?php
  session_destroy();
  $url = $_SERVER['PHP_SELF']."?function=login";
  echo "<script>window.location = '$url'</script>";
?>
