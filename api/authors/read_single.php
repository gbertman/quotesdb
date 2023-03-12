<?php

    include_once "../../models/authors.php";

    function readSingle( $db, $id){ 

        $authors = new Authors($db);

        $results = $authors->readSingle($id);

        $num = $results->rowCount();

        if( $num > 0 ){

            echo json_encode($results->fetch(PDO::FETCH_ASSOC));

        } else {
            echo "{ \"message\": \"author_id Not Found\" }";
        }
        
    }
?>