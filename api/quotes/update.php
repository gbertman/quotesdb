<?php

    include_once "../../models/quotes.php";

    function update( $db, $id, $quote, $authorId, $categoryId ){ 

        $quotes = new Quotes($db);

        $results = $quotes->update( $id, $quote, $authorId, $categoryId );

        echo json_encode($results);
        
    }
?>