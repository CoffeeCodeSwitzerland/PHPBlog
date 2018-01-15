<?php
  $myfile = fopen("exchange/export.csv", "w") or die("Unable to open file!");
  $written = false;
  $users = getUsers();
  foreach($users as $user){
    $entry = $user[1].";".$user[2].";".$user[3];
    fwrite($myfile, $entry."\n");
    $written = true;
  }
  fclose($myfile);
  if($written){
    echo "Benutzer wurden aus der Datenbank in die Datei 'exchange/export.csv' geschrieben.";
  }
?>
