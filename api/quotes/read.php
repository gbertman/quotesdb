<?php

    include_once "../../models/categories.php";

    function read($db, $random ){ 

        $quotes = new Quotes($db);

        $results = $quotes->read();

        if( $random && is_array( $results[0] ) ){
            $numOfRows = count($results);
            $num = rand(0, $numOfRows -1 );
            echo json_encode( $results[$num] );
        }
        else
            echo json_encode($results);

    }
    
?>