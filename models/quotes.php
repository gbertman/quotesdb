<?php
    class Quotes {
        //DB Connection and table
        private $conn;
        private $table = 'quotes';
        private $table2 = 'categories';
        private $table3 = 'authors';
        
        //constructor
        public function __construct( $db ){
            $this->conn = $db;
        }

        public function read() {
            $query = 
                "SELECT 
                    a.id,
                    a.quote,
                    b.category,
                    c.author
                FROM
                    {$this->table} a
                LEFT JOIN {$this->table2} b
                ON a.category_id = b.id
                LEFT JOIN {$this->table3} c
                ON a.author_id = c.id
                ";

            try{
                //Prepare
                $stmt = $this->conn->prepare($query);

                //Execute query
                $success = $stmt->execute();

                if( $success ){

                    $num = $stmt->rowCount();

                    if( $num > 0 ){
            
                        return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
                    } else {
                        return array( "message"=>"quote_id Not Found" );
                    }
                }
                else
                    echo 'Quote Query Error';

            } catch( PDOException $e ){

                echo 'Quotes Query Error: ' . $e->getMessage();
            }


        }

        public function readSingle( $id ){

            $query = 
            "SELECT 
                a.id,
                a.quote,
                b.category,
                c.author
            FROM
                {$this->table}
            LEFT JOIN {$this->table2} b
            ON a.category_id = b.id
            LEFT JOIN {$this->table3} c
            ON a.author_id = c.id
            WHERE
                a.id = :ID
    
            ";

            try{
                //Prepare
                $stmt = $this->conn->prepare($query);

                $stmt->bindValue( ":ID", $id );

                //Execute query
                $success = $stmt->execute();

                if( $success ){

                    $num = $stmt->rowCount();

                    if( $num > 0 ){
            
                        return $stmt->fetch(PDO::FETCH_ASSOC);
            
                    } else {
                        return array( "message"=>"Quote_id Not Found" );
                    }
                }
                else
                    echo 'Quote Query Error';

            } catch( PDOException $e ){

                echo 'Quote Query Error: ' . $e->getMessage();
            }

        }

        public function create( $Quote ){

            $query = 
            "INSERT INTO
                {$this->table} (Quote)
            VALUES ( :Quote )";

            try{
                //Prepare
                $stmt = $this->conn->prepare($query);

                $stmt->bindValue( ":Quote", $Quote );

                //Execute query
                $success = $stmt->execute();
                
                if( $success ){

                    $lastId = $this->conn->lastInsertId();

                    $record_arr = $this->readSingle( $lastId );

                    return $record_arr;
                }
                else  
                    echo 'Quote Create Error: Record not created';

            } catch( PDOException $e ){

                echo 'Quote Query Error: ' . $e->getMessage();
            }

        }

        public function update( $id, $Quote ){

            $query =
                "UPDATE
                    {$this->table}
                SET
                    Quote = :Quote
                WHERE 
                    id = :ID";
            try{
                //Prepare
                $stmt = $this->conn->prepare($query);

                $stmt->bindValue( ":Quote", $Quote );
                $stmt->bindValue( ":ID", $id );

                //Execute query
                $success = $stmt->execute();
                
                if( $success ){
                
                    return $this->readSingle( $id );
                }
                else  
                    echo 'Quote Update Error: Record not updated';

            } catch( PDOException $e ){

                echo 'Quote Update Error: ' . $e->getMessage();
            }

        }

        public function delete( $id ){

            $query =
                "DELETE FROM
                    {$this->table}
                WHERE 
                    ( id = :ID )";
            try{
                //Prepare
                $stmt = $this->conn->prepare($query);

                $stmt->bindValue( ":ID", $id );

                //Execute query
                $success = $stmt->execute();
                
                if( $success )
                    return array( "id"=>$id );
                else
                    return array("message"=>"Quote_id Not Found");

            } catch( PDOException $e ){

                echo 'Quote Delete Error: ' . $e->getMessage();
            }

        }
        
    }
?>