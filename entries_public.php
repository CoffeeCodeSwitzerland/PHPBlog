<?php
  // Alle Blogeinträge holen, die Blog-ID ist in der Variablen $blogId gespeichert (wird in index.php gesetzt)
  // Hier Code... (Schlaufe über alle Einträge dieses Blogs)

  // Nachfolgend das Beispiel einer Ausgabe in HTML, dieser Teil muss mit einer Schlaufe über alle Blog-Beiträge und der Ausgabe mit PHP ersetzt werden
  $blogEntries = getEntries($blogId);
  $col1 = "";
  $col2 = "";

  foreach($blogEntries as $entry)
  {
    $col1 .= "<div class='container' style='margin-top:80px;display:inline;'>
      <div class='card text-black mb-3' style='max-width: 20rem;'>
        <a href='index.php?function=entries_public&bid=".$blogId."&eid=".$entry['eid']."' title='Blog auswählen'><div class='card-header'>".$entry['title']."</div></a>
        <div class='card-body'>
          <p class='card-text'>".substr($entry['content'],0,20)."....</p>
        </div>
      </div>";
  }


  foreach($blogEntries as $entry)
  {
    if($entry['eid'] == $entryId)
    {
      $col2 .= $entry['content'];
    }
  }
  echo "<div class='container'><div class='row'><div class='col-4'>".$col1."</div><div class='col-8'>".$col2."</div></div></div>";
?>
