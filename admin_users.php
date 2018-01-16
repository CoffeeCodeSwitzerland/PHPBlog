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
                    Entfernen
                </div>
                <ul class="list-group list-group-flush">
                    <?php
                    foreach ($users as $user){
                        if($user['name'] != 'name' && $user['name'] != 'admin') {
                            echo "<li class='list-group-item'>
                                    ".$user['name']."
                                             <button type='button' onclick='location.href=\"".$_SERVER['PHP_SELF']."?function=admin_user_remove&bid=".$user['uid']."\"' class='btn btn-secondary btn-lg btn-block'>Benutzer entfernen</button>
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
                    Erstellen
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class='list-group-item'>
                            Normal
                        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] . '?function=admin_user_add&bid='.$blogId.'&eid='.$entryId ?>">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Min. 4 chars">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Min. 4 chars">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Passwort</label>
                                <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Min. 8 chars">
                            </div>
                            <button type="submit" class="btn btn-primary">Erstellen</button>
                        </form>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card" style="width: 50rem;">
                <div class="card-header">
                    CSV
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                      <li class='list-group-item'>
                          <h3>Import</h3>
                          <?php
                          echo "<form style='font-size:80%;' action='".$_SERVER['PHP_SELF']."?function=csv_import' method='post' enctype='multipart/form-data'>
                          <label for='file'>Datei:</label>
                          <input type='file' name='fileToUpload' id='file'><br>
                          <input type='submit' name='submit' value='Daten von Datei importieren'>
                          </form>";
                          ?>
                          <br>
                          <h3>Export</h3>
                          <h3 style="font-size:90%;color:grey;font-weight:bold;">Bestehende Datei</h3>
                          <?php
                          echo "<form style='font-size:80%;' action='".$_SERVER['PHP_SELF']."?function=csv_export' method='post' enctype='multipart/form-data'>
                          <label for='file'>Datei:</label>
                          <input type='file' name='fileToUpload' id='file'><br>
                          <input type='submit' name='submit' value='Daten von Datenbank exportieren'>
                          </form>";
                          ?>
                          <br>
                          <h3 style="font-size:90%;color:grey;font-weight:bold;">Datei erstellen</h3>
                          <?php
                          echo "<form style='font-size:80%;' action='".$_SERVER['PHP_SELF']."?function=csv_export' method='post' enctype='multipart/form-data'>
                          <label for='file'>Datei:</label>
                          <input type='text' name='fileNameToExportTo' id='file'><br>
                          <input type='submit' name='submit' value='Daten von Datenbank exportieren'>
                          </form>";
                          ?>
                      </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
