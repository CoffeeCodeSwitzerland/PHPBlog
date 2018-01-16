<?php

if(isset($_FILES["fileToUpload"])){
$target_dir = "exchange/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
// Check if file already exists
if (file_exists($target_file)) {
    echo "Entschuldigung, die Datei existiert bereits.<br>";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
   echo "Entschuldigung, die Datei ist zu gross.<br>";
   $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Entschuldigung, die Datei konnte nicht hochgeladen werden.<br>";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "Die Datei '". basename( $_FILES["fileToUpload"]["name"]). "' wurde erfolgreich nach 'exchange/' hochgeladen.<br>";
    } else {
        echo "Entschuldigung, die Datei konnte nicht hochgeladen werden.<br>";
    }
}

  $myfile = fopen($target_file, "w") or die("Unable to open file!");
  $written = false;
  $users = getUsers();
  $counter = 0;
  foreach($users as $user){
    $entry = (string)((string)$user[1].";".(string)$user[2].";".(string)$user[3]);
    fwrite($myfile, $entry."\n");
    $counter += 1;
    $written = true;
  }
  fclose($myfile);

  $file_url = "http://".$_SERVER['SERVER_NAME'].substr($_SERVER['PHP_SELF'],0,strlen($_SERVER['PHP_SELF'])-10)."/".$target_file;

  if($written){
    echo (string)$counter . " Benutzer wurden aus der Datenbank in die Datei '".$_FILES["fileToUpload"]["tmp_name"]."' geschrieben.";
    header("Location: $file_url");
    //unlink($target_file);
  }
} else if(isset($_POST['fileNameToExportTo'])){
  $target_dir = "exchange/";
  $target_file = $target_dir . $_POST['fileNameToExportTo'];
  $uploadOk = 1;
  // Check if file already exists
  if (file_exists($target_file)) {
      echo "Entschuldigung, die Datei existiert bereits.<br>";
      $uploadOk = 0;
  }
    $myfile = fopen($target_file, "w") or die("Unable to open file!");
    $written = false;
    $users = getUsers();
    $counter = 0;
    foreach($users as $user){
      $entry = (string)((string)$user[1].";".(string)$user[2].";".(string)$user[3]);
      fwrite($myfile, $entry."\n");
      $counter += 1;
      $written = true;
    }
    fclose($myfile);

    $file_url = "http://".$_SERVER['SERVER_NAME'].substr($_SERVER['PHP_SELF'],0,strlen($_SERVER['PHP_SELF'])-10)."/".$target_file;

    if($written){
      echo (string)$counter . " Benutzer wurden aus der Datenbank in die Datei '".$_FILES["fileToUpload"]["tmp_name"]."' geschrieben.";
      header("Location: $file_url");
      //unlink($target_file);
    }
}
/*
  $url = $_SERVER['PHP_SELF'].'?function=csv_export';

  echo "<form action='".$url."' method='post' enctype='multipart/form-data'>
  <label for='file'>Datei:</label>
  <input type='file' name='fileToUpload' id='file'><br>
  <input type='submit' name='submit' value='Daten von Datenbank exportieren'>
  </form>";*/

?>
