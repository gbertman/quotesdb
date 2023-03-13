<?php

    include_once "../../models/quotes.php";

    function update( $db, $id, $quote){ 

        $quotes = new Quotes($db);

        $results = $quotes->update( $id, $quotes );

        echo json_encode($results);
        
    }
?>