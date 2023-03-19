<?php

    include_once "../../models/quotes.php";

    function readAuthorCategory( $db, $authorId, $categoryId, $random ){ 

        $quotes = new Quotes($db);

        $results = $quotes->readAuthorCategory($authorId, $categoryId);

        if( $random && is_array( $results[0] ) ){
            $numOfRows = count($results);
            $num = rand(0, $numOfRows -1 );
            echo json_encode( $results[$num] );
        }
        else
            echo json_encode($results);
    }
?>