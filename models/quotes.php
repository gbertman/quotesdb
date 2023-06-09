<?php
    include_once "authors.php";
    include_once "categories.php";

    class Quotes {
        //DB Connection and table
        private $conn;
        private $table = 'quotes';
        private $table2 = 'categories';
        private $table3 = 'authors';

        private function numOfRows( $tableToLookAt ){

            $query = "SELECT * FROM {$tableToLookAt}";

            try{
                //Prepare
                $stmt = $this->conn->prepare($query);

                //Execute query
                $success = $stmt->execute();

                $num = $stmt->rowCount();  
                
                return $num;

            } catch( PDOException $e ){

                echo 'Quote Query Error: ' . $e->getMessage();
            }
        }
        
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
                        return array( "message"=>"No Quotes Found" );
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
                    {$this->table} a
                LEFT JOIN {$this->table2} b
                ON a.category_id = b.id
                LEFT JOIN {$this->table3} c
                ON a.author_id = c.id
                WHERE
                    a.id = :ID

                ";

            if( $id === "random" ){
                $numRows = numberOfRows( "quote" );
                $id = rand(1, $numRows );
            }

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
                        return array( "message"=>"No Quotes Found" );
                    }
                }
                else
                    echo 'Quote Query Error';

            } catch( PDOException $e ){

                echo 'Quote Query Error: ' . $e->getMessage();
            }

        }

        public function readAuthorCategory( $authorId, $categoryId ){

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
            WHERE
                a.category_id = :CategoryId AND a.author_id = :AuthorId
            ";

            try{
                //Prepare
                $stmt = $this->conn->prepare($query);

                $stmt->bindValue( ":CategoryId", $categoryId );
                $stmt->bindValue( ":AuthorId", $authorId );

                //Execute query
                $success = $stmt->execute();

                if( $success ){

                    $num = $stmt->rowCount();

                    if( $num > 0 ){
            
                        return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
                    } else {
                        return array( "message"=>"No Quotes Found" );
                    }
                }
                else
                    echo 'Quote Query Error';

            } catch( PDOException $e ){

                echo 'Quote Query Error: ' . $e->getMessage();
            }

        }

        public function readAuthor( $authorId ){

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
            WHERE
                a.author_id = :AuthorId
    
            ";

            try{
                //Prepare
                $stmt = $this->conn->prepare($query);

                $stmt->bindValue( ":AuthorId", $authorId );

                //Execute query
                $success = $stmt->execute();

                if( $success ){

                    $num = $stmt->rowCount();

                    if( $num > 0 ){
            
                        return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
                    } else {
                        return array( "message"=>"No Quotes Found" );
                    }
                }
                else
                    echo 'Quote Query Error';

            } catch( PDOException $e ){

                echo 'Quote Query Error: ' . $e->getMessage();
            }

        }

        public function readCategory( $categoryId ){

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
            WHERE
                a.category_id = :CategoryId
    
            ";

            try{
                //Prepare
                $stmt = $this->conn->prepare($query);

                $stmt->bindValue( ":CategoryId", $categoryId );

                //Execute query
                $success = $stmt->execute();

                if( $success ){

                    $num = $stmt->rowCount();

                    if( $num > 0 ){
            
                        return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
                    } else {
                        return array( "message"=>"No Quotes Found" );
                    }
                }
                else
                    echo 'Quote Query Error';

            } catch( PDOException $e ){

                echo 'Quote Query Error: ' . $e->getMessage();
            }

        }

        private function selectSingle( $id ){

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
                        return array( "message"=>"No Quotes Found" );
                    }
                }
                else
                    echo 'Quote Query Error';

            } catch( PDOException $e ){

                echo 'Quote Query Error: ' . $e->getMessage();
            }

        }

        public function create( $quote, $authorId, $categoryId ){

            $query = 
            "INSERT INTO
                {$this->table} (quote, author_id, category_id)
            VALUES ( :Quote, :AuthorId, :CategoryId )";

            $authors = new Authors( $this->conn );
            $categories = new Categories( $this->conn );
            
            $authorResult = $authors->readSingle( $authorId );
            if( !empty( $authorResult['message'] ) )
                return $authorResult;
            
            $categoryResult = $categories->readSingle( $categoryId );
            if( !empty( $categoryResult['message'] ))
                return $categoryResult;
            
            try{
                //Prepare
                $stmt = $this->conn->prepare($query);

                $stmt->bindValue( ":Quote", $quote );
                $stmt->bindValue( ":AuthorId", $authorId );
                $stmt->bindValue( ":CategoryId", $categoryId );

                //Execute query
                $success = $stmt->execute();

                $num = $stmt->rowCount();
                
                if( $num > 0 ){

                    $lastId = $this->conn->lastInsertId();

                    $record_arr = $this->selectSingle( $lastId );

                    return $record_arr;
                }
                else  
                    return array( "message"=>"No Quotes Found" );

            } catch( PDOException $e ){

                echo 'Quote Query Error: ' . $e->getMessage();
            }
            
        }

        public function update( $id, $quote, $authorId, $categoryId ){

            $query =
                "UPDATE
                    {$this->table}
                SET
                    quote = :QuoteVal, category_id = :CategoryId, author_id = :AuthorId 
                WHERE 
                    id = :ID";
            
            $authors = new Authors( $this->conn );
            $categories = new Categories( $this->conn );

            $authorResult = $authors->readSingle( $authorId );
            if( !empty($authorResult['message']) )
                return $authorResult;

            $categoryResult = $categories->readSingle( $categoryId );
            if( !empty($categoryResult["message"]))
                return $categoryResult;
            
            try{
                //Prepare
                $stmt = $this->conn->prepare($query);
                
                $stmt->bindValue( ":QuoteVal", $quote );
                $stmt->bindValue( ":CategoryId", $categoryId );
                $stmt->bindValue( ":AuthorId", $authorId );
                $stmt->bindValue( ":ID", $id );

                //Execute query
                $success = $stmt->execute();
                
                $num = $stmt->rowCount();
                
                if( $num > 0 ){
                
                    return $this->selectSingle( $id );
                }
                else  
                    return array( "message"=>"No Quotes Found" );
                
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

                $num = $stmt->rowCount();
                
                if( $num > 0 )
                    return array( "id"=>$id );
                else
                    return array( "message"=>"No Quotes Found" );

            } catch( PDOException $e ){

                echo 'Quote Delete Error: ' . $e->getMessage();
            }

        }
        
    }
?>