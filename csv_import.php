<?php
  $csvFile = file('exchange/import.csv');
  $data = [];
  $entities = [];
  foreach ($csvFile as $line) {
      array_push($data,str_getcsv($line, ";"));
  }

  $people = [];
  foreach ($data as $column) {
    $person = [];
    array_push($person,$column[0]);
    array_push($person,$column[1]);
    array_push($person,$column[2]);
    array_push($people,$person);
  }
  //print_r(array_values($people));

  foreach ($people as $p) {
    // $p[0]=name, $p[1]=email, $p[2]=password, role=1
    addUser($p[0], $p[1], $p[2], 1);
    echo "User hinzugefügt...<br>";
  }
?>
