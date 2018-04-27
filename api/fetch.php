<?php
include('db.php');
include('functions.php');
$tab_results = get_all_Posts();
$results=$tab_results['results'];
$recordsTotal=$tab_results['count'];
$filtered_rows=$recordsTotal;

if(isset($_POST["search"]["value"]))
{
    $searched_value=$_POST["search"]["value"];
    $tab=get_all_Posts($searched_value);
    $results=$tab['results'];
    $filtered_rows=$tab['count'];
}

error_log(print_r($results,true));

$data = array();
if (count($results)>0){
    foreach ($results as $p){
        $sub_array=array();
        $sub_array[]=$p["idPost"];
        $sub_array[]=$p["title"];
        $sub_array[]=$p["creationDate"];
        $span='<span class="badge badge-danger">Non publie</span>';
        if ($p["published"]==1){
            $span='<span class="badge badge-primary">Publie</span>';
        }
        $sub_array[]=$span;
        //Les actions
        $btn_update = '<button type="button" name="update" id="'.$p["idPost"].'" class="btn btn-outline-warning btn-xs update">Edit</button>';
        $btn_delete = '<button type="button" name="delete" id="'.$p["idPost"].'" class="btn btn-outline-danger btn-xs delete">delete</button>';
        $sub_array[]=$btn_update.$btn_delete;
        
        $data[]=$sub_array;
    }
}

$output = array(
    "draw"    => intval($_POST["draw"]),
    "recordsTotal"  =>  $recordsTotal,
    "recordsFiltered" => $filtered_rows,
    "data"    => $data
);

echo json_encode($output);