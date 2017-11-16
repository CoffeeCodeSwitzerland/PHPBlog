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
    echo "<div class='card' style='width: 20rem;'>
      <div class='card-body'>
        <h4 class='card-title'></h4>
        <a href='index.php?function=entries_public&bid=".$blogId."&eid=".$entry['eid']."' title='Blog auswählen'><div class='card-header'>".$entry['title']."</div></a>
      </div>
    </div>";
  }
  echo "</div>";
  echo "<div class='col'>";

  foreach($blogEntries as $entry)
  {
    if($entry['eid'] == $entryId)
    {
      echo $entry['content'];
    }
  }

  echo "</div>";
  echo "</div>";
?>
