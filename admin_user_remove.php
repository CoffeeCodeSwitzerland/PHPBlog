<?php
if (isset($_SESSION['isAdmin'])) {
    if ($_SESSION['isAdmin'] == "true") {
        if (isset($_GET['bid'])) {
            $users = getUsers();
            $authorized = true;
            foreach ($users as $user) {
                if ($user['name'] == 'admin' && $user['uid'] == $blogId) {
                    $authorized = false;
                    echo "false ";
                }else {
                    echo "true ";
                }
            }

            if($authorized){
                deleteUserById($blogId);
                echo "deleted";
            }
        }
        $url = $_SERVER['PHP_SELF'] . "?function=admin_users&bid=" . $blogId;
        echo "<script>window.location = '$url'</script>";
    } else {
        $url = $_SERVER['PHP_SELF'] . "?function=login" . $blogId;
        echo "<script>window.location = '$url'</script>";
    }
}
?>