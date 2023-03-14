<?php
    class Categories {
        //DB Connection and table
        private $conn;
        private $table = 'categories';
        
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
                        return array( "message"=>"category_id Not Found" );
                    }
                }
                else
                    echo 'Category Query Error';

            } catch( PDOException $e ){

                echo 'Category Query Error: ' . $e->getMessage();
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
                        return array( "message"=>"category_id Not Found" );
                    }
                }
                else
                    echo 'Category Query Error';

            } catch( PDOException $e ){

                echo 'Category Query Error: ' . $e->getMessage();
            }

        }

        public function create( $category ){

            $query = 
            "INSERT INTO
                {$this->table} (category)
            VALUES ( :Category )";

            try{
                //Prepare
                $stmt = $this->conn->prepare($query);

                $stmt->bindValue( ":Category", $category );

                //Execute query
                $success = $stmt->execute();
                
                if( $success ){

                    $lastId = $this->conn->lastInsertId();

                    $record_arr = $this->readSingle( $lastId );

                    return $record_arr;
                }
                else  
                    echo 'Category Create Error: Record not created';

            } catch( PDOException $e ){

                echo 'Category Query Error: ' . $e->getMessage();
            }

        }

        public function update( $id, $category ){

            $query =
                "UPDATE
                    {$this->table}
                SET
                    category = :Category
                WHERE 
                    id = :ID";
            try{
                //Prepare
                $stmt = $this->conn->prepare($query);

                $stmt->bindValue( ":Category", $category );
                $stmt->bindValue( ":ID", $id );

                //Execute query
                $success = $stmt->execute();
                
                if( $success ){
                
                    return $this->readSingle( $id );
                }
                else  
                    echo 'Category Update Error: Record not updated';

            } catch( PDOException $e ){

                echo 'Category Update Error: ' . $e->getMessage();
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
                    return array("message"=>"category_id Not Found");

            } catch( PDOException $e ){

                echo 'Category Delete Error: ' . $e->getMessage();
            }

        }
        
    }
?>