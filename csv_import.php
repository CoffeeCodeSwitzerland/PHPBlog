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

$csvFile = file($target_file);
  $data = [];
  $entities = [];
  foreach ($csvFile as $line) {
      array_push($data,str_getcsv($line, ";"));
  }
  unlink($target_file);

  $people = [];
  foreach ($data as $column) {
    $person = [];
    array_push($person,$column[0]);
    array_push($person,$column[1]);
    array_push($person,$column[2]);
    array_push($people,$person);
  }
  //print_r(array_values($people));

  $counter = 0;
  foreach ($people as $p) {
    // $p[0]=name, $p[1]=email, $p[2]=password, role=1
    addUser($p[0], $p[1], $p[2], 1);
    $counter += 1;
  }
  echo (string)$counter . " User hinzugefügt...<br>";
}
  $url = $_SERVER['PHP_SELF'].'?function=csv_import';

  echo "<form action='".$url."' method='post' enctype='multipart/form-data'>
  <label for='file'>Datei:</label>
  <input type='file' name='fileToUpload' id='file'><br>
  <input type='submit' name='submit' value='Daten von Datei importieren'>
  </form>";
?>
