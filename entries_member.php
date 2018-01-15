<?php
// Alle Blogeinträge holen, die Blog-ID ist in der Variablen $blogId gespeichert (wird in index.php gesetzt)
// Hier Code... (Schlaufe über alle Einträge dieses Blogs)

// Nachfolgend das Beispiel einer Ausgabe in HTML, dieser Teil muss mit einer Schlaufe über alle Blog-Beiträge und der Ausgabe mit PHP ersetzt werden
$blogEntries = getEntries(getUserIdFromSession());
$comments = [];
if(isset($_GET['eid'])) {
    $comments = getComments($entryId);
}


?>
<div class='container' style='margin:0;'>
    <div class='row'>
        <div class='col'>
            <?php
            foreach ($blogEntries as $entry) {
                echo "<div class='card' style='width:40rem;height:15rem;margin-bottom:2rem;'>
                        <a href='index.php?function=entries_member&eid=" . $entry['eid'] . "' title='Blog auswählen' style='color:black;text-decoration:none;'>
                            <div class='card-body'>
                                 <h4 class='card-title'>" . date('Y-m-d H:i:s', $entry['datetime']) . "</h4>
                                    <div class='card-header'>" . $entry['title'] . "</div>
                                     <p class='card-text'>" . substr($entry['content'], 0, 25) . "...</p>
                            </div>
                        </a>
                     </div>";
            }
            ?>

        </div>
        <div class='col'>
            <div class='row'>
                <?php
                foreach ($blogEntries as $entry) {
                    if ($entry['eid'] == $entryId) {
                        echo "<div class='container text'>";
                        echo "<a href=" . $_SERVER['PHP_SELF'] . "?function=entries_modify&eid=" . $entryId . "><h2>" . $entry['title'] . "</h2></a>";
                        echo "<p>" . nl2br($entry['content']) . "</p>";
                        echo "</div>";
                    }
                }
                ?>
            </div>
            <div class='row' style='padding-top:2vw;'>
                <h3 class='comment'>Kommentare</h3>

                <?php
                if (sizeof($comments) == 0) {
                    echo "<p>Keine Kommentare vorhanden</p>";
                }
                foreach ($comments as $comment) {
                    echo "<div class='card' style='width:40vw;margin-bottom:1vw;margin-top: 1vw;'>
                            <div class='card-body'>
                                <h4 class='card-title'>Autor:" . $comment['name'] . "</h4>
                                 <p>" . nl2br($comment['content']) . "</p>
                             </div>
                             <button onclick='location.href=\"".$_SERVER['PHP_SELF']."?function=comment_remove&eid=".$entryId."&cid=".$comment['cid']."\"' class='btn btn-primary' type='button' class='btn btn-secondary btn-lg btn-block'>Remove</button>
                         </div>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
