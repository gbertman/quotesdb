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
    include_once "./read_author.php";
    include_once "./read_author_category.php";
    include_once "./read_category.php";

    //connect to database and then create the connection to pass
    $database = new Database();
    $db = $database->connect();

    //get the method and select the correct view
    $method = $_SERVER['REQUEST_METHOD'];
    
    //If it is a get without a parameter do a general read else find the particular record with the if.
    if( $method === "GET" ){
        if( isset($_GET['random']) && $_GET['random'] === "true" ){
            $random = true;
        } else {
            $random = false;
        }
                
        if( isset($_GET['id']) ){
            $id = $_GET['id'];
            readSingle( $db, $id );
        }
        else if( isset( $_GET['author_id']) && isset( $_GET['category_id']) ) {
            $authorId = $_GET['author_id'];
            $categoryId = $_GET['category_id'];
            readAuthorCategory( $db, $authorId, $categoryId, $random );
        }
        else if( isset($_GET['author_id']) ) {
            $authorId = $_GET['author_id'];
            readAuthor( $db, $authorId, $random );
        }
        else if( isset($_GET['category_id']) ) {
            $categoryId = $_GET['category_id'];
            readCategory( $db, $categoryId, $random );
        }
        else
            read($db, $random );
    }
    //Post method

    if( $method === "POST" ){
        $data = json_decode( file_get_contents('php://input') );
        if( empty( $data->quote ) || empty( $data->author_id ) || empty( $data->category_id ) )
            echo json_encode( array( "message"=>"Missing Required Parameters") );
        else {
            $quote = $data->quote;
            $categoryId = $data->category_id;
            $authorId = $data->author_id;
            create($db, $quote, $authorId, $categoryId );
        }
    }
    
    if( $method === "PUT" ){
        $data = json_decode(file_get_contents('php://input'));
        if( empty( $data->id ) || empty( $data->quote ) || empty( $data->author_id ) || empty( $data->category_id ) )
            echo json_encode( array( "message"=>"Missing Required Parameters") );
        else {
            $id = $data->id;
            $quote = $data->quote;
            $categoryId = $data->category_id;
            $authorId = $data->author_id;
            update($db, $id, $quote, $authorId, $categoryId );
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
