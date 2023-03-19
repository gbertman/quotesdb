<?php

    include_once "../../models/quotes.php";

    function readCategory( $db, $categoryId, $random){ 

        $quotes = new Quotes($db);

        $results = $quotes->readCategory($categoryId);

        if( $random && is_array( $results[0] ) ){
            $numOfRows = count($results);
            $num = rand(0, $numOfRows -1 );
            echo json_encode( $results[$num] );
        }
        else
            echo json_encode($results);
    }
?>