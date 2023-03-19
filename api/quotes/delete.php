<?php

    include_once "../../models/quotes.php";

    function delete( $db, $id ){ 

        $quotes = new Quotes($db);

        $result = $quotes->delete( $id );

        echo json_encode( $result );
        
    }
?>