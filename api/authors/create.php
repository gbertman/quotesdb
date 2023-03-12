<?php

    include_once "../../models/authors.php";

    function create( $db, $author){ 

        $authors = new Authors($db);

        $results = $authors->create($author);

        $num = $results->rowCount();

        if( $num > 0 ){

            echo json_encode($results->fetch(PDO::FETCH_ASSOC));

        } else {
            echo "{ message: 'author_id Not Found' }";
        }
        
    }
?>