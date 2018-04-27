<?php
include ('db.php');
include ('functions.php');
$success=false;
if (isset($_POST["operation"])) {
    $operation = $_POST["operation"];
    
    if ($operation == 'Add' ||$operation == 'Edit' ) {
        $data = array(
            'ID_POST' => $_POST["ID_POST"],
            'TITLE_POST' => $_POST["TITLE_POST"],
            'CONTENT_POST' => $_POST["CONTENT_POST"],
            'PUBLISHED_POST' => (isset($_POST["PUBLISHED_POST"])) ? $_POST["PUBLISHED_POST"] : 0
        );
        $success=manage_post($data);
    }
}
echo json_encode(array(
    'success' => $success
));