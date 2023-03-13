<?php

    include_once "../../models/categories.php";

    function delete( $db, $id ){ 

        $categories = new Categories($db);

        $result = $categories->delete( $id );

        if( $result )
            echo json_encode( array( "id"=>$id ) );
        else {
            echo json_encode( array("message"=>"category_id Not Found") );
        }
        
    }
?>