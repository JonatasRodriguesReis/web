<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
class Data{
 
    // datareparobase connection and table name
    private $conn;
    private $table_name = "datavalor";
    public $data;
    public $valor;
   
  
    // constructor with $db as datareparobase connection
    public function __construct($db){
        $this->conn = $db;
    }
    function getAll(){

        $query = "SELECT data,valor  FROM datavalor";
        $stmt = $this->conn->prepare( $query );        
        
        $stmt->execute();
        $num = $stmt->rowCount();
        $datas = array();
 
        // check if more than 0 record found
        if($num>0){
         
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row); 
                $datavalor_item=array();       
                array_push($datavalor_item, $data);
                array_push($datavalor_item, $valor);
                array_push($datas,$datavalor_item);
            }
        }     
        return $datas;
    }

    // create product
    function create(){
    
        // query to insert record
        $query = "insert into datavalor set data=:data, valor=:valor";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->data=htmlspecialchars(strip_tags($this->data));
        $this->valor=htmlspecialchars(strip_tags($this->valor));
        
    
        // bind values
        $stmt->bindParam(":data", $this->data);
        $stmt->bindParam(":valor", $this->valor);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }
}