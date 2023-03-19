<?php

    include_once "../../models/categories.php";

    function update( $db, $id, $category){ 

        $categories = new Categories($db);

        $results = $categories->update( $id, $category );

        echo json_encode($results);
        
    }
?>