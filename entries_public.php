<?php
// Alle Blogeinträge holen, die Blog-ID ist in der Variablen $blogId gespeichert (wird in index.php gesetzt)
// Hier Code... (Schlaufe über alle Einträge dieses Blogs)

// Nachfolgend das Beispiel einer Ausgabe in HTML, dieser Teil muss mit einer Schlaufe über alle Blog-Beiträge und der Ausgabe mit PHP ersetzt werden

if(isset($_GET['bid'])){
    if(!userExistsByUid($_GET['bid'])){
        $url = $_SERVER['PHP_SELF'] . "?function=blogs";
        echo "<script>window.location = '$url'</script>";
    }
}

$blogEntries = getEntries($blogId);
$comments = [];
$hide = true;
if(isset($_GET['eid'])) {
    $comments = getComments($entryId);
    $hide = false;
}
?>

<div class='container' style='margin:0;'>
    <div class='row'>
        <div class='col'>
            <?php
            foreach ($blogEntries as $entry) {
                echo "<div class='card' style='width:40rem;height:15rem;margin-bottom:2rem;'>
                            <a href='index.php?function=entries_public&bid=" . $blogId . "&eid=" . $entry['eid'] . "' title='Blog auswählen' style='color:black;text-decoration:none;'>
                              <div class='card-body'>
                                <h4 class='card-title'>" . date('Y-m-d H:i:s', $entry['datetime']) . "</h4>
                                <div class='card-header'>" . $entry['title'] . "</div>
                                <p class='card-text'>" . substr($entry['content'], 0, 25) . "...</p>
                              </div>
                              </a>
                            </div>
    ";
            }
            ?>
        </div>
        <div class='col'>
            <div class='row'>
                <?php
                if (sizeof($blogEntries) == 0) {
                    print "<p>Keine Einträge vorhanden</p>";
                }
                foreach ($blogEntries as $entry) {
                    if ($entry['eid'] == $entryId) {
                        echo "<div class='container text'>";
                        echo "<h2>" . $entry['title'] . "</h2>";
                        echo "<p>" . nl2br($entry['content']) . "</p>";
                        echo "</div>";
                    }
                }
                ?>
            </div>
            <div class='row' >
                <h3 class='comment'>Kommentare</h3>
                <?php
                if (sizeof($comments) == 0 and !$hide) {
                    echo "<p>Keine Kommentare vorhanden</p>";
                }
                foreach ($comments as $comment) {
                    echo "<div class='container'>
                             <div class='card' style='width:40vw;margin-bottom:1vw;margin-top: 1vw;'>
                                <div class='card-body'>
                                    <h4 class='card-title'>Autor: " . $comment['name'] . " - Erstellt: " . date('Y-m-d H:i:s', $comment['datetime']). "</h4>
                                         <p>" . nl2br($comment['content']) . "</p>
                                 </div>
                             </div>
                        </div>";
                }
                ?>
                <div <?php if($hide) echo 'hidden' ?>>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] . '?function=comment_add&bid='.$blogId.'&eid='.$entryId ?>">
                    <div class="form-group" style="width:40vw;" name="<?php echo $entryId; ?>">
                        <!-- <label for="exampleFormControlInput1">Eintrag</label>
                        <input type="text" class="form-control" id="commentEid" name="eid"
                               value="<?php echo $entryId; ?>" readonly> -->
                    </div>
                    <div class="form-group" style="width:40vw;" name="<?php echo $entryId; ?>">
                        <label for="exampleFormControlInput1">Autor</label>
                        <input type="text" class="form-control" id="commentAutor" name="name" placeholder="Autor">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Kommentar</label>
                        <textarea class="form-control" style="font-size:1vw;" id="commentText" rows="3"
                                  name='content'></textarea>
                    </div>
                    <button type="submit" style="font-size:1.2vw;" class="btn btn-primary">Erstellen</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
