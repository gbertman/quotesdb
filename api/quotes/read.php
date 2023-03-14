<?php

    include_once "../../models/categories.php";

    function read($db){ 

        $quotes = new Quotes($db);

        $results = $quotes->read();

        echo json_encode($results);

    }
    
?>