<?php
if(getUserIdFromSession() != 0) {
    if (!empty($_GET)) {
        if (isset($_GET['cid'])) $cid = $_GET['cid'];
        deleteComment($cid);
        $url = $_SERVER['PHP_SELF'] . "?function=entries_member&eid=" . $entryId;
        echo "<script>window.location = '$url'</script>";
    }
}
?>