<?php

    include_once "../../models/quotes.php";

    function readCategory( $db, $categoryId){ 

        $quotes = new Quotes($db);

        $results = $quotes->readCategory($categoryId);

        echo json_encode($results);
    }
?>