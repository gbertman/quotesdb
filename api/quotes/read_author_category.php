<?php

    include_once "../../models/quotes.php";

    function readAuthorCategory( $db, $authorId, $categoryId ){ 

        $quotes = new Quotes($db);

        $results = $quotes->readAuthorCategory($authorId, $categoryId);

        echo json_encode($results);
    }
?>