<?php

// var_dump(get_all_Posts());
function manage_post($data)
{
    include ('db.php');
    $success = false;
    if (count($data) > 0) {
        $dateNow = new DateTime();
        
        if ($data['ID_POST'] > 0) {
            //UPDATE `post` SET `title` = 'titre te' WHERE `post`.`idPost` = 1;
            $statement = $bdd->prepare("UPDATE post SET title=:title,content=:content,published=:published WHERE idPost =:idPost");
            $result = $statement->execute(array(
                ':idPost' => $data["ID_POST"],
                ':title' => $data["TITLE_POST"],
                ':content' => $data["CONTENT_POST"],
                ':published' => $data["PUBLISHED_POST"]
            ));
            $success = $result;
        } else {
            $statement = $bdd->prepare("INSERT INTO post (title,creationDate, content, published) VALUES (:title, :creationDate, :content, :published)");
            $result = $statement->execute(array(
                ':title' => $data["TITLE_POST"],
                ':creationDate' => $dateNow->format('Y-m-d H:i:s'),
                ':content' => $data["CONTENT_POST"],
                ':published' => $data["PUBLISHED_POST"]
            ));
            $success = $result;
        }
    }
    return $success;
}

function get_all_Posts($searched_value = null)
{
    include ('db.php');
    if (isset($searched_value) && ! empty($searched_value)) {
        
        $query = 'SELECT * FROM post WHERE title LIKE "%' . $searched_value . '%" OR content LIKE "%' . $searched_value . '%" ORDER BY idPost DESC';
        
        $statement = $bdd->prepare($query);
    } else {
        $statement = $bdd->prepare("SELECT * FROM post ORDER BY idPost DESC");
    }
    $statement->execute();
    $result = $statement->fetchAll();
    $count = $statement->rowCount();
    return array(
        'results' => $result,
        'count' => $count
    );
}
function get_Post_By_Id($idPost)
{
    include ('db.php');
    $statement = $bdd->prepare("SELECT * FROM post WHERE idPost = '".$idPost."' LIMIT 1");
    $statement->execute();
    $result = $statement->fetchAll();
    return $result;
}
function delete_post($idPost)
{
    include ('db.php');
    $statement = $bdd->prepare("DELETE FROM post WHERE idPost = :id");
    $result = $statement->execute(array(':id' => $idPost));
    return $result;
}