<?php
  if(!empty($_POST)) {
    $content = "";
    $eid = "";
    $name = "";

    $isComplete = true;

    if(isset($_POST['content'])) $content = $_POST['content'];
    if(isset($_POST['eid'])) $eid = $_POST['eid'];
    if(isset($_POST['name'])) $name = $_POST['name'];

    // if(strlen(trim($content)) == 0) $isComplete = false;
    // if(strlen(trim($eid)) == 0) $isComplete = false;
    // if(strlen(trim($name)) == 0) $isComplete = false;

    echo $content;
    echo $eid;
    echo $name;

    echo "post";

    if($isComplete) {
      addComment($entryId, $name, $content);
      echo "post2";
      $url = $_SERVER['PHP_SELF']."?function=entries_public&bid=" . $blogId . "&eid=" . $entryId;
      echo "<script>window.location = '$url'</script>";
    }
  }
?>
