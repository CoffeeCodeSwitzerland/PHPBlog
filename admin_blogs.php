<?php
$users = "";
$entries = "";
if (isset($_SESSION['isAdmin'])) {
    if ($_SESSION['isAdmin'] == "true") {
        $users = getUsers();
        $counter = 0;
        $idAdmin = 0;
        $idName = 0;
        foreach ($users as $user){
            if($user['name'] == 'name'){
                $idName = $counter;
            }
            if($user['name'] == 'admin'){
                $idAdmin = $counter;
            }
            $counter += 1;
        }
        $entries = getEntries($blogId);
//        if($idAdmin != $blogId){
//            $entries = getEntries($blogId);
//        }else{
//            echo "FAILURE IS ADMIN";
//        }
    }
} else {
    $url = $_SERVER['PHP_SELF'] . "?function=login" . $uid;
    echo "<script>window.location = '$url'</script>";
}
?>
<html>
    <body>
        <div class='container-fluid'>
            <div class="row">
                <div class="col">
                    <div class="card" style="width: 50rem;">
                        <div class="card-header">
                            Benutzer
                        </div>
                        <ul class="list-group list-group-flush">
                            <?php
                                foreach ($users as $user){
                                    if($user['name'] != 'name' && $user['name'] != 'admin') {
                                        echo "<li class='list-group-item'>
                                                 <a href=" . $_SERVER['PHP_SELF'] . "?function=admin_blogs&bid=" . $user['uid'] . ">" . $user['name'] . "</a>
                                              </li>";
                                    }
                                }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="width: 50rem;">
                        <div class="card-header">
                            Einträge
                        </div>
                        <ul class="list-group list-group-flush">
                            <?php
                            if(sizeof($entries) == 0){
                                echo "<p>Keine Einträge vorhanen</p>";
                            }
                            foreach ($entries as $entry){
                                echo "<li class='list-group-item'>
                                            ". $entry['title']."
                                            <button type='button' onclick='location.href=\"".$_SERVER['PHP_SELF']."?function=entries_remove&eid=".$entry['eid']."&bid=".$blogId."\"' class='btn btn-secondary btn-lg btn-block'>Eintrag entfernen</button>
                                      </li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
