<?php

    include_once "../../models/authors.php";

    function read($db){ 

        $authors = new Authors($db);

        $results = $authors->read();

        $num = $results->rowCount();

        if( $num > 0 ){

            $result_arr = array();

            $result_arr = $results->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode($result_arr);

        } else {
            echo "{ message: ‘author_id Not Found’ }";
        }
        
    }
?>