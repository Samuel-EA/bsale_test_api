<?php
class Product{
 
    // database connection and table name
    private $conn;
    private $table_name;
    private $records;
    private $page;
    private $pages;
    private $total;
    private $limit;
    private $first;
    private $previous;
    private $next;
    private $last;
    private $start;
    private $end;
    private $search;
 
    // constructor with $db as database connection
    public function __construct($db,$table,$records = 25,$page = 1, $search){
        $this->conn = $db;
        $this->table_name = $table;
        $this->records = $records;
        $this->page = $page;
        $this->search = $search;
    }

    // get product
    function searchProduct(){

        $countquery = "SELECT COUNT(id) AS total
        FROM " . $this->table_name . " WHERE name LIKE '%".$this->search."%'";

        // prepare query
        $stmt = $this->conn->prepare($countquery);

        // execute query
        if($stmt->execute()){
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->total = $data['total'];
        }

        $this->pages = ceil($this->total/$this->records);
        $this->limit = ($this->page - 1) * $this->records;


        // query to get record
        $query = "SELECT *
                FROM " . $this->table_name . "  WHERE
                name LIKE '%".$this->search."%'
                ORDER BY name DESC
                LIMIT ". $this->limit.",".$this->records;

        // prepare query
        $stmt = $this->conn->prepare($query);

        $this->first = 1;
        $this->previous = $this->page>1?$this->page-1:1;
        $this->next = $this->page + 1;
        $this->last = ceil($this->total/$this->records);

        if ($this->next > $this->last)
            $this->next = $this->last;

        $this->start=$this->page;
        $this->end=$this->start+($this->pages-1);
        
		if($this->end>$this->last)
			$this->end=$this->last;

        if(($this->end-$this->start+1)<$this->pages)
		{
			$this->start-=$this->pages-($this->end-$this->start+1);
        }
        
        if(($this->end-$this->start+1)==$this->pages)
		{
			$this->start=$this->page-floor($this->pages/2);
			$this->end=$this->page+floor($this->pages/2);
			while($this->start<$this->first)
			{
				$this->start++;
				$this->end++;
			}
			while($this->end>$this->last)
			{
				$this->start--;
				$this->end--;
			}
		}
        
        if($this->start<1)
				$this->start=1;

        // execute query
        if($stmt->execute() && $this->search != "" && $this->search != null){
            $data = $stmt->fetchall(PDO::FETCH_ASSOC);
            $rawdata = array( "data" => $data,  
                              "records" => $this->records, 
                              "page" => $this->page, 
                              "pages" => $this->pages,  
                              "total" => $this->total, 
                              "limit" => $this->limit, 
                              "first" => $this->first, 
                              "previous" => $this->previous, 
                              "next" => $this->next, 
                              "last" => $this->last, 
                              "start" => $this->start, 
                              "end" => $this->end);
            return json_encode($rawdata);
        }
        
        $rawdata = array( "error" => "Error en la petición al servidor", "message" => var_dump($stmt));

        return $rawdata;
        
    }

}