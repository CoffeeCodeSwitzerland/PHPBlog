<?php
if (isset($_SESSION['isAdmin'])) {
    if ($_SESSION['isAdmin'] == "true") {
        $url = $_SERVER['PHP_SELF'] . "?function=admin_users";
        if (isset($_POST['name'])) $name = $_POST['name'];
        if (isset($_POST['email'])) $email = $_POST['email'];
        if (isset($_POST['password'])) $password = $_POST['password'];

        print getUserByEmail($email);

        if (getUserByEmail($email) == 0) {
            if (strlen($name) > 4 && strlen($password) >= 8) {
                addUser($name, $email, $password, 1);
            }
        }
        echo "<script>window.location = '$url'</script>";
    } else {
        $url = $_SERVER['PHP_SELF'] . "?function=login" . $blogId;
        echo "<script>window.location = '$url'</script>";
    }
}
?>