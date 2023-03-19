<?php

    include_once "../../models/categories.php";

    function delete( $db, $id ){ 

        $categories = new Categories($db);

        $result = $categories->delete( $id );

        echo json_encode( $result );
        
    }
?>