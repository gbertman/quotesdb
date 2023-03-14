<?php
    class Authors {
        //DB Connection and table
        private $conn;
        private $table = 'authors';
        
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
                $success = $stmt->execute();

                if( $success ){

                    $num = $stmt->rowCount();

                    if( $num > 0 ){
            
                        return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
                    } else {
                        return array( "message"=>"author_id Not Found" );
                    }
                }
                else
                    echo 'Author Query Error';

            } catch( PDOException $e ){

                echo 'Author Query Error: ' . $e->getMessage();
            }


        }

        public function readSingle( $id ){

            $query = 
            "SELECT 
                *
            FROM
                {$this->table}
            WHERE
                id = :ID
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
                        return array( "message"=>"author_id Not Found" );
                    }
                }
                else
                    echo 'Author Query Error';

            } catch( PDOException $e ){

                echo 'Author Query Error: ' . $e->getMessage();
            }

        }

        public function create( $author ){

            $query = 
            "INSERT INTO
                {$this->table} (author)
            VALUES ( :Author )";

            try{
                //Prepare
                $stmt = $this->conn->prepare($query);

                $stmt->bindValue( ":Author", $author );

                //Execute query
                $success = $stmt->execute();
                
                if( $success ){

                    $lastId = $this->conn->lastInsertId();

                    $record_arr = $this->readSingle( $lastId );

                    return $record_arr;
                }
                else  
                    echo 'Author Create Error: Record not created';

            } catch( PDOException $e ){

                echo 'Author Query Error: ' . $e->getMessage();
            }

        }

        public function update( $id, $author ){

            $query =
                "UPDATE
                    {$this->table}
                SET
                    author = :Author
                WHERE 
                    id = :ID";
            try{
                //Prepare
                $stmt = $this->conn->prepare($query);

                $stmt->bindValue( ":Author", $author );
                $stmt->bindValue( ":ID", $id );

                //Execute query
                $success = $stmt->execute();
                
                if( $success ){
                
                    return $this->readSingle( $id );
                }
                else  
                    echo 'Author Update Error: Record not updated';

            } catch( PDOException $e ){

                echo 'Author Update Error: ' . $e->getMessage();
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

                $num = $stmt->rowCount();
                
                if( $num > 0 )
                    return array( "id"=>$id );
                else
                    return array( "message"=>"author_id Not Found" );

            } catch( PDOException $e ){

                echo 'Author Delete Error: ' . $e->getMessage();
            }

        }
        
    }
?>