<?php
  // Alle Blogeinträge holen, die Blog-ID ist in der Variablen $blogId gespeichert (wird in index.php gesetzt)
  // Hier Code... (Schlaufe über alle Einträge dieses Blogs)

  // Nachfolgend das Beispiel einer Ausgabe in HTML, dieser Teil muss mit einer Schlaufe über alle Blog-Beiträge und der Ausgabe mit PHP ersetzt werden
  $blogEntries = getEntries($blogId);
  $col1 = "";
  $col2 = "";

  echo "<div class='container'>";
  echo "<div class='row'>";
  echo "<div class='col'>";
  foreach($blogEntries as $entry)
  {
    echo "<div class='card' style='width:40rem;height:15rem;margin-bottom:2rem;'>
      <a href='index.php?function=entries_public&bid=".$blogId."&eid=".$entry['eid']."' title='Blog auswählen' style='color:black;text-decoration:none;'>
      <div class='card-body'>
        <h4 class='card-title'>" . date( 'Y-m-d H:i:s', $entry['datetime'] ). "</h4>
        <div class='card-header'>".$entry['title']."</div>
        <p class='card-text'>" . substr($entry['content'], 0, 25) . "...</p>
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
      echo "<h2>".$entry['title']."</h2>";
      echo "<p>" . nl2br($entry['content']) . "</p>";
      echo "</div>";
    }
  }

  echo "</div>";
  echo "</div>";
?>
