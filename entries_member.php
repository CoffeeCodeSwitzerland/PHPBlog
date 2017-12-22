<?php
  // Alle Blogeinträge holen, die Blog-ID ist in der Variablen $blogId gespeichert (wird in index.php gesetzt)
  // Hier Code... (Schlaufe über alle Einträge dieses Blogs)

  // Nachfolgend das Beispiel einer Ausgabe in HTML, dieser Teil muss mit einer Schlaufe über alle Blog-Beiträge und der Ausgabe mit PHP ersetzt werden
  $blogEntries = getEntries(getUserIdFromSession());
  $col1 = "";
  $col2 = "";

  // echo "<h1>Willkommen im Memberbereich!</h1><br>";
  echo "<div class='container' style='margin:0;'>";
  echo "<div class='row'>";
  echo "<div class='col'>";
  foreach($blogEntries as $entry)
  {
    echo "<div class='card' style='width:40rem;height:15rem;margin-bottom:2rem;'>
      <a href='index.php?function=entries_member&eid=".$entry['eid']."' title='Blog auswählen' style='color:black;text-decoration:none;'>
      <div class='card-body'>
        <h4 class='card-title'>" . date( 'Y-m-d H:i:s', $entry['datetime'] ). "</h4>
        <div class='card-header'>".$entry['title']."</div>
      </div>
    </div>
    </a>";
  }
  echo "</div>";
  echo "<div class='col'>";

  foreach($blogEntries as $entry)
  {
    if($entry['eid'] == $entryId)
    {
      echo "<div class='container text'>";
      echo "<a href=".$_SERVER['PHP_SELF']."?function=entries_modify&eid=". $entryId ."><h2>".$entry['title']."</h2></a>";
      echo "<p>" . nl2br($entry['content']) . "</p>";
      echo "</div>";
    }
  }

  echo "</div>";
  echo "</div>";
?>
