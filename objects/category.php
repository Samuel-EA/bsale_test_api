<?php
class Category{
 
    // database connection and table name
    private $conn;
    private $table_name = "category";
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // get category
    function getCategories(){
    
        // query to get records
        $query = "SELECT
                category.id,
                category.name
                FROM " . $this->table_name . " ORDER BY 
                category.name ASC";
    
        // prepare query
        $stmt = $this->conn->prepare($query);

        // execute query
        if($stmt->execute()){
            $data = $stmt->fetchall(PDO::FETCH_ASSOC);
            $rawdata = array( "data" => $data);
            return json_encode($rawdata);
        }
        
        $rawdata = array( "error" => "Tenemos problemas al obtener las categorías ", "message" => var_dump($stmt));

        return json_encode($rawdata);
        
    }
}