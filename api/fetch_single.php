<?php
include ('db.php');
include ('functions.php');
if (isset($_POST["post_id"])) {
    $idPost = $_POST["post_id"];
    $result = get_Post_By_Id($idPost);
    $output = array();
    if (count($result) > 0) {
        foreach ($result as $row) {
            $output["title"] = $row["title"];
            $output["content"] = $row["content"];
            $output["published"] = $row["published"];
        }
    }
    echo json_encode($output);
}