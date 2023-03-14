<?php

    include_once "../../models/authors.php";

    function delete( $db, $id ){ 

        $authors = new Authors($db);

        $result = $authors->delete( $id );

        echo json_encode( $results );
        
    }
?>