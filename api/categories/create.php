<?php

    include_once "../../models/categories.php";

    function create( $db, $category){ 

        $categories = new Categories($db);

        $results = $categories->create($category);

        echo json_encode($results);
        
    }
?>