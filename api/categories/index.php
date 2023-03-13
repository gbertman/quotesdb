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
        $data = json_decode( file_get_contents('php://input') );
        if( empty( $data->category ) )
            echo json_encode( array( "message"=>"Missing Required Parameters") );
        else {
           $category = $data->category;
            create($db, $category );
        }
    }
    
    if( $method === "PUT" ){
        $data = json_decode(file_get_contents('php://input'));
        if( empty($data->category) && empty($data->id))
            echo json_encode( array( "message"=>"Missing Required Parameters") );
        else {
            $category = $data->category;
            $id = $data->id;
            update( $db, $id, $category );
        }
    }

    if( $method === "DELETE" ){
        $data = json_decode(file_get_contents('php://input'));
        if( empty($data->id))
            echo json_encode( array( "message"=>"Missing Required Parameters") );
        else {
           $id = $data->id;
            delete($db, $id );
        }
    }
    
?>
