<?php

    include_once "../../models/quotes.php";

    function create( $db, $quote){ 

        $quotes = new Quotes($db);

        $results = $quotes->create($quote);

        echo json_encode($results);
        
    }
?>