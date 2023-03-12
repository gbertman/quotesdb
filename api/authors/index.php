<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
        exit();
    }

    //load views
    include_once "../../config/database.php";
    include_once "./read.php";
    include_once "./read_single.php";
    include_once "./create.php";
    include_once "./update.php";
    include_once "./delete.php";

    //connect to database and then create the connection to pass
    $database = new Database();
    $db = $database->connect();

    //get the method and select the correct view
    $method = $_SERVER['REQUEST_METHOD'];
    
    //If it is a get without a parameter do a general read else find the particular record with the if.
    if( $method === "GET" )
        if( isset($_GET['id']) ){
            $id = $_GET['id'];
            readSingle( $db, $id );
        }
        else
            read($db);

    if( $method === "POST" ){
        if( empty($_POST['author']) )
            echo "{ message: 'Missing Required Parameters' }";
        else {
           $author = $_POST['author'];
            create($db, $author );
        }
    }
    
    if( $method === "PUT" ){
        parse_str(file_get_contents('php://input'), $_PUT);
        if( empty($_PUT['author']) && empty($_PUT['id']))
            echo "{ message: 'Missing Required Parameters' }";
        else {
            $author = $_PUT['author'];
            $id = $_PUT['id'];
            update( $db, $id, $author );
        }
    }

    if( $method === "DELETE" ){
        parse_str(file_get_contents('php://input'), $_DELETE);
        if( empty($_DELETE['id']) )
            echo "{ message: 'Missing Required Parameters' }";
        else {
           $id = $_DELETE['id'];
            delete($db, $id );
        }
    }
    
?>
