<?php

    include_once "../../models/quotes.php";

    function create( $db, $quote, $authorId, $categoryId ){ 

        $quotes = new Quotes($db);

        $results = $quotes->create($quote, $authorId, $categoryId );

        echo json_encode($results);
        
    }
?>