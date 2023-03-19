<?php

    include_once "../../models/authors.php";

    function create( $db, $author){ 

        $authors = new Authors($db);

        $results = $authors->create($author);

        echo json_encode($results);
        
    }
?>