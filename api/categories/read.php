<?php

    include_once "../../models/categories.php";

    function read($db){ 

        $categories = new Categories($db);

        $results = $categories->read();

        echo json_encode($results);

    }
?>