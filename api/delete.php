<?php
include ('db.php');
include ("functions.php");
$success = false;
if (isset($_POST["post_id"])) {
    $result = delete_post($_POST["post_id"]);
    
    if (! empty($result)) {
        $success = true;
    }
}
echo json_encode(array(
    'success' => $success
));