<?php

    include_once "../../models/authors.php";

    function delete( $db, $id ){ 

        $authors = new Authors($db);

        $result = $authors->delete( $id );

        if( $result )
            echo json_encode( array( "id"=>$id ) );
        else {
            echo json_encode( array("message"=>"author_id Not Found") );
        }
        
    }
?>