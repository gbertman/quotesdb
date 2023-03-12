<?php

    include_once "../../models/quotes.php";

    function read($db){ 
        $quotes = new Quotes($db);

        $results = $quotes->read();

        $num = $results->rowCount();

        if( $num > 0 ){

            $quote_arr = array();

            $quote_arr = $results->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode($quote_arr);

        } else {
            echo "message: ";
        }
        
    }
?>