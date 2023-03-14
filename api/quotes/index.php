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
    include_once "./read_category";

    //connect to database and then create the connection to pass
    $database = new Database();
    $db = $database->connect();

    //get the method and select the correct view
    $method = $_SERVER['REQUEST_METHOD'];
    
    //If it is a get without a parameter do a general read else find the particular record with the if.
    if( $method === "GET" ){
        if( isset($_GET['id']) ){
            $id = $_GET['id'];
            readSingle( $db, $id );
        }
        else if( isset( $_GET['authorId']) && isset( $_GET['categoryId']) ) {
            $authorId = $_GET['authorId'];
            $categoryId = $_GET['categoryId'];
            readAuthorCategory( $db, $authorId, $categoryId );
        }
        else if( isset($_GET['authorId']) ) {
            $authorId = $_GET['authorId'];
            readAuthor( $db, $authorId );
        }
        else if( isset($_GET['categoryId']) ) {
            $categoryId = $_GET['categoryId'];
            readCategory( $db, $categoryId );
        }
       /* else if( isset($GET_random['random'])){
            if( isset($_GET['authorId']) ) {
                $authorId = $_GET['authorId'];
                randomAuthor( $db, $authorId );
            }
            else if( isset($_GET['categoryId']) ) {
                $categoryId = $_GET['categoryId'];
                randomCategory( $db, $categoryId );
            } else {
                random($db);
            }
        }*/
        else
            read($db);
    }

    if( $method === "POST" ){
        $data = json_decode( file_get_contents('php://input') );
        if( empty( $data->quote ) || empty( $data->authorId ) || empty( $data->categoryId ) )
            echo json_encode( array( "message"=>"Missing Required Parameters") );
        else {
           $quote = $data->quote;
           $categoryId = $data->categoryId;
           $authorId = $data->authorId;

            create($db, $quote, $authorId, $categoryId );
        }
    }
    
    if( $method === "PUT" ){
        $data = json_decode(file_get_contents('php://input'));
        if( empty( $data->id ) || empty( $data->quote ) || empty( $data->authorId ) || empty( $data->categoryId ) )
            echo json_encode( array( "message"=>"Missing Required Parameters") );
        else {
            $id = $data->id;
            $quote = $data->quote;
            $categoryId = $data->categoryId;
            $authorId = $data->authorId;
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
