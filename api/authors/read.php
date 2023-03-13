<?php

    include_once "../../models/authors.php";

    function read($db){ 

        $authors = new Authors($db);

        $results = $authors->read();

        echo json_encode($results);

    }
?>