<?php

    include_once "../../models/categories.php";

    function readSingle( $db, $id){ 

        $categories = new Categories($db);

        $results = $categories->readSingle($id);

        echo json_encode($results);
    }
?>