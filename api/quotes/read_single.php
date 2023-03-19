<?php

    include_once "../../models/quotes.php";

    function readSingle( $db, $id){ 

        $quotes = new Quotes($db);

        $results = $quotes->readSingle($id);

        echo json_encode($results);
    }
?>