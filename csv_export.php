<?php

function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( 'Users: " . $output . "' );</script>";
}

  $myfile = fopen("exchange/export.csv", "w") or die("Unable to open file!");

  $users = getUserNames();
  foreach($users as $user){
    $entry = $user[1].";".$user[2];
    fwrite($myfile, $entry."\n");
  }
  fclose($myfile);
?>
