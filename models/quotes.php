<?php
    class Quotes {
        //DB Connection and table
        private $conn;
        private $table = 'quotes';

        //Post table
        public $id;
        public $quote;
        public $category_id;
        public $author_id;
        
        //constructor
        public function __construct( $db ){
            $this->conn = $db;
        }


        public function read() {
            $query = 
                "SELECT 
                    *
                FROM
                    {$this->table}
                ";

            try{
                //Prepare
                $stmt = $this->conn->prepare($query);

                //Execute query
                $stmt->execute();

                return $stmt;

            } catch( PDOException $e ){

                echo 'Quotes Query Error: ' . $e->getMessage();
            }


        }

        
    }
?>