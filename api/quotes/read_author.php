<?php

    include_once "../../models/quotes.php";

    function readAuthor( $db, $authorId){ 

        $quotes = new Quotes($db);

        $results = $quotes->readAuthor($authorId);

        echo json_encode($results);
    }
?>