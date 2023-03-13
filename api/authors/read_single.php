<?php

    include_once "../../models/authors.php";

    function readSingle( $db, $id){ 

        $authors = new Authors($db);

        $results = $authors->readSingle($id);

        echo json_encode($results);
    }
?>