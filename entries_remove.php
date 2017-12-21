<?php
  if(getUserIdFromSession() != 0)
  {
    if(getEntry($_GET['eid']) != "")
    {
    ?>
    <script>
            if(confirm('Möchten Sie den Beitrag wirklich löschen?'))
            {
              //alert("clicked ok");
                <?php
                deleteEntry($_GET['eid']);
                $url = $_SERVER['PHP_SELF'].'?function=entries_member';
                ?>
                window.location = "<?php echo $url; ?>";
            } /*else {
              alert("clicked cancel");
              alert("not deleted");
            }*/
    </script>
<?php
    } else {
      echo "<h1 style='color:red;'>Fehler!\n Dieser Beitrag existiert nicht.</h1><br>";
    }
  }
?>
