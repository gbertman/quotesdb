<?php

    include_once "../../models/authors.php";

    function update( $db, $id, $author){ 

        $authors = new Authors($db);

        $results = $authors->update( $id, $author );

        echo json_encode($results);
        
    }
?>