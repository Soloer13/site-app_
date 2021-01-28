<?php
class Database{
  
    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "masirah-site";
    private $username = "root";
    private $password = "";
    public $conn;
    public $mysqlConn;
  
    // get the database connection
    public function getConnection(){
  
        $this->conn = null;
  
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }


    //this was created for the problem happened at waterAnalysis update
    public function getMysqlConnection(){
        $this->mysqlConn = null;

        $this->conn = mysqli_connect($this->host, $this->username, $this->password,$this->db_name);               
        // echo "connect done";      
        if ($this->conn->connect_error) {
            die('Error : ('. $this->conn->connect_errno .') '. $this->conn->connect_error);
            echo "died";
        }


        return $this->conn;
    }

}
?>