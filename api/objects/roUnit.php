<?php
class ROUnit{
  
    // database connection and table name
    private $conn;
    private $table_name = "roUnit";
  
    // object properties
    public $ROId;
    public $unit;
    public $created_on;
    public $modified_on;
    
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read roUnit
    function read(){
      
        //select all query
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY ROId";
      
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // echo($query);
      
        // execute query
        $stmt->execute();
      
        return $stmt;
    }


    // create roUnit
    function create(){
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    unit=:unit, created_on=:created_on, modified_on=:modified_on";

        // $query = 'INSERT INTO '. $this->table_name .' (`unit`, `created_on`, `modified_on`) VALUES (?, ?, ?)';


        // prepare query
        $stmt = $this->conn->prepare($query);
      
        // sanitize
        $this->unit=htmlspecialchars(strip_tags($this->unit));
      
        $this->created_on = date('Y-m-d H:i:s');
        // echo($this->created_on);
        $this->modified_on = ''; //can't be null

        // $data = [
        //     "unit"=>$this->unit,
        //     "created_on"=>$this->created_on,
        //     "modified_on"=>$this->modified_on
        // ];

        // print_r($data);

        // bind values
        $stmt->bindParam(":unit", $this->unit);
        $stmt->bindParam(":created_on", $this->created_on);
        $stmt->bindParam(":modified_on", $this->modified_on);

        // echo($query);
        // echo($stmt);
        // print_r($stmt);

        // execute query
        if($stmt->execute()){
            return true;
        }
        // print_r($stmt->execute());
        return false; 
    }

    // used when filling up the update roUnit form
    function readOne(){
      
        // query to read single record
        $query = "SELECT * FROM " . $this->table_name . " WHERE ROId = ? LIMIT 0,1";
      
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
      
        // bind id of roUnit to be updated
        $stmt->bindParam(1, $this->ROId);
      
        // execute query
        $stmt->execute();
      
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
      
        // set values to object properties
        $this->ROId = $row['ROId'];
        $this->unit = $row['unit'];
        $this->created_on = $row['created_on'];
        $this->modified = $row['modified_on'];
    }


    // update the roUnit
    function update(){
      
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    unit = :unit,
                    modified_on = :modified_on
                WHERE
                    `". $this->table_name . "`. `ROId` = :ROId";
      
        // prepare query statement
        $stmt = $this->conn->prepare($query);
      
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->unit));
      
        // bind new values
        $stmt->bindParam(':unit', $this->unit);
        $stmt->bindParam(':modified_on', $this->modified_on);
        $stmt->bindParam(':ROId', $this->ROId);

        // print_r($stmt);
        // execute the query
        if($stmt->execute()){
            return true;
        }
      
        return false;
    }

    // delete the roUnit
    function delete(){
      
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE ROId = ?";
      
        // prepare query
        $stmt = $this->conn->prepare($query);
      
        // sanitize
        $this->ROId=htmlspecialchars(strip_tags($this->ROId));
      
        // bind id of record to delete
        $stmt->bindParam(1, $this->ROId);
      
        // execute query
        if($stmt->execute()){
            return true;
        }
      
        return false;
    }

    // search roUnits
    function search($keywords){
      
        // select all query
        $query = "SELECT * FROM " . $this->table_name . " WHERE unit LIKE ? ORDER BY ROId DESC";
      
        // prepare query statement
        $stmt = $this->conn->prepare($query);
      
        // sanitize
        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";
      
        // bind
        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
        $stmt->bindParam(3, $keywords);
      
        // execute query
        $stmt->execute();
        return $stmt;
    }
}
?>