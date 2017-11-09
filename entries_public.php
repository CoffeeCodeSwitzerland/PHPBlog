<?php
  // Alle Blogeinträge holen, die Blog-ID ist in der Variablen $blogId gespeichert (wird in index.php gesetzt)
  // Hier Code... (Schlaufe über alle Einträge dieses Blogs)

  // Nachfolgend das Beispiel einer Ausgabe in HTML, dieser Teil muss mit einer Schlaufe über alle Blog-Beiträge und der Ausgabe mit PHP ersetzt werden
  $blogEntries = getEntries($blogId);
  foreach($blogEntries as $entry)
  {
    echo "<div class='container' style='margin-top:80px;display:inline;'>
      <div class='card text-black mb-3' style='max-width: 20rem;'>
        <a href='index.php?function=blogs&bid=".$blogId."' title='Blog auswählen'><div class='card-header'>".$entry['title']."</div></a>
        <div class='card-body'>
          <p class='card-text'>".substr($entry['content'],0,20)."....</p>
        </div>
      </div>";
  }
?>
