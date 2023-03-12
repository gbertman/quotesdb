<?php

    include_once "../../models/authors.php";

    function update( $db, $id, $author){ 

        $authors = new Authors($db);

        $results = $authors->update( $id, $author );

        $num = $results->rowCount();

        if( $num > 0 ){

            echo json_encode($results->fetch(PDO::FETCH_ASSOC));

        } else {
            echo "{ \"message\": \"author_id Not Found\" }";
        }
        
    }
?>