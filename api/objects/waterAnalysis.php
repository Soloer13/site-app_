<?php
class WaterAnalysis
{

    // database connection and table name
    private $conn;
    private $table_name = "waterAnalysis";
    private $table_name2 = "rounit";

    // object properties
    public $waterAnalysisId;
    public $cond;
    public $temp;
    public $ph;
    public $orp;
    public $product;
    public $roin;
    public $roout;
    public $date;
    public $unit;
    public $shift; //this for shift or time
    public $shiftStr; //shift string naming ("Morning", "Night", or other naming in the future)
    public $created_on;
    public $modified_on;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // read roUnit
    function read()
    {

        //select all query
        $query = "SELECT wateranalysis.*, rounit.unit FROM `wateranalysis` left join rounit on wateranalysis.Unit = rounit.ROId";

        // $query = "SELECT * FROM " . $this->table_name . " LEFT JOIN ".$this->table_name2 ." ON " 
        //     .$this->table_name->waterAnalysisId. " ORDER BY date";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // echo($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function read_current_month(){
        //select all query
        $query = "SELECT wateranalysis.*, rounit.unit FROM `wateranalysis` left join rounit on wateranalysis.Unit = rounit.ROId 
                    Where Month(wateranalysis.date)= Month(CURRENT_DATE);";

        // $query = "SELECT * FROM " . $this->table_name . " LEFT JOIN ".$this->table_name2 ." ON " 
        //     .$this->table_name->waterAnalysisId. " ORDER BY date";

        // print_r($query);
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // echo($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }


    // create waterAnalysis
    function create()
    {
        // query to insert record
        // $query = "INSERT INTO
        //             " . $this->table_name . "
        //         SET
        //             Unit=:unit, cond=:cond, temp=:temp, ph=:ph, orp=:orp, product=:product, roin=:roin, roout=:roout, 
        //             date=:date, shift=:shift, created_on=:created_on;";

        $query = 'INSERT INTO '. $this->table_name . ' SET Unit='. $this->unit .' ,cond=' .$this->cond.', temp='. $this->temp. ', ph='. $this->ph. 
        ', orp='.$this->orp. ', product=' .$this->product. ', roin='.$this->roin.', roout='.$this->roout.', date='
        .'"' .$this->date.'"'. ' , daynight=' .$this->shift. ', created_on=' .'"'.$this->created_on. '";';

        // prepare query
        // $stmt = $this->conn->prepare($query);

        // sanitize
        // $this->unit = htmlspecialchars(strip_tags($this->unit));

        // bind values
        // $stmt->bindParam(":unit", $this->unit);
        // $stmt->bindParam(":cond", $this->cond);
        // $stmt->bindParam(":temp", $this->temp);
        // $stmt->bindParam(":ph", $this->ph);
        // $stmt->bindParam(":orp", $this->orp);
        // $stmt->bindParam(":product", $this->product);
        // $stmt->bindParam(":roin", $this->roin);
        // $stmt->bindParam(":roout", $this->roout);
        // $stmt->bindParam(":date", $this->date);
        // $stmt->bindParam(":shift", $this->shift);
        // $stmt->bindParam(":created_on", $this->created_on);
        // $stmt->bindParam(":modified_on", $this->modified_on);

        // echo($query);
        // print_r($stmt);
        // print_r(get_defined_vars());
        // echo($this->created_on);
        // print_r($this->unit);
        // print_r($this->cond);
        // print_r($this->temp);
        // print_r($this->ph);
        // print_r($this->orp);
        // print_r($this->product);
        // print_r($this->roin);
        // print_r($this->roout);
        // print_r($this->date);
        // print_r($this->shift);

        // print_r($query);
        // echo($query);

        // if($this->conn){
        //     // print_r($this->conn);
        // }

        // execute the query
        if (mysqli_query($this->conn, $query)) {
            return true;
        }
        else
        {
            printf("error: %s\n", mysqli_error($this->conn));
        }

        return false;
    

        // // execute query
        // if ($stmt->execute()) {
        //     return true;
        // }
        // // print_r($stmt->execute());
        // return false;
    }

    // used when filling up the update roUnit form
    function readOne()
    {

        // query to read single record
        $query = "SELECT * FROM " . $this->table_name . " WHERE waterAnalysisId = ? LIMIT 0,1";
        $query = "SELECT wateranalysis.*, rounit.unit FROM `wateranalysis` left join rounit on wateranalysis.Unit = rounit.ROId
                    WHERE waterAnalysisId = ? LIMIT 0,1";
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind id of roUnit to be updated
        $stmt->bindParam(1, $this->waterAnalysisId);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // print_r($row);
        
        // set values to object properties
        $this->waterAnalysisId = $row['waterAnalysisId'];
        $this->unit = $row['unit'];
        $this->cond = $row['cond'];
        $this->temp = $row['temp'];
        $this->ph = $row['ph'];
        $this->orp = $row['orp'];
        $this->product = $row['product'];
        $this->roin = $row['roin'];
        $this->roout = $row['roout'];
        $this->date = $row['date'];
        $this->shift = $row['daynight'];
        $this->created_on = $row['created_on'];
        $this->modified_on = $row['modified_on'];
    }


    // update the roUnit
    function update()
    {
        // update query
        // $query = "UPDATE
        //             " . $this->table_name . "
        //         SET
        //         cond=:cond, temp=:temp, ph=:ph, orp=:orp, product=:product, roin=:roin, roout=:roout, date=:date,
        //         shift=:shift, Unit=:unit, modified_on=:modified_on
        //         WHERE
        //         waterAnalysisId = :waterAnalysisId";

        $query = 'UPDATE '. $this->table_name . ' SET cond=' .$this->cond.', temp='. $this->temp. ', ph='. $this->ph. 
        ', orp='.$this->orp. ', product=' .$this->product. ', roin='.$this->roin.', roout='.$this->roout.', date='
        .'"' .$this->date.'"'. ' , daynight=' .$this->shift. ', modified_on=' .'"'.$this->modified_on. '"'.
        ' WHERE waterAnalysisId=' . $this->waterAnalysisId;


        // print_r($query);
        // prepare query statement
        // $db = $this->conn;
        // print_r($this->conn);

        // if (!$db) {
        //     // die("Connection failed: " . mysqli_connect_error());
        // }

        //$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //$stmt = $db->prepare($query);

        // sanitize
        // $this->name = htmlspecialchars(strip_tags($this->unit));

        // bind new values
        // $stmt->bindParam(':waterAnalysisId', $this->waterAnalysisId);
        // $stmt->bindParam(':cond', $this->cond);
        // $stmt->bindParam(':temp', $this->temp);
        // $stmt->bindParam(':ph', $this->ph);
        // $stmt->bindParam(':orp', $this->orp);
        // $stmt->bindParam(':product', $this->product);
        // $stmt->bindParam(':roin', $this->roin);
        // $stmt->bindParam(':roout', $this->roout);
        // $stmt->bindParam(':date', $this->date);
        // $stmt->bindParam(':daynight', $this->shift);
        // // $stmt->bindParam(':shift', $this->shift);
        // // $stmt->bindParam(':unit', $this->unit);
        // $stmt->bindParam(':modified_on', $this->modified_on);

        // execute the query
        if (mysqli_query($this->conn, $query)) {
            return true;
        }
        else
        {
            printf("error: %s\n", mysqli_error($this->conn));
        }

        return false;
    }

    // delete the roUnit
    function delete()
    {

        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE waterAnalysisId = ?";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->waterAnalysisId = htmlspecialchars(strip_tags($this->waterAnalysisId));

        // bind id of record to delete
        $stmt->bindParam(1, $this->waterAnalysisId);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // search roUnits
    function search($keywords)
    {

        // select all query
        $query = "SELECT * FROM " . $this->table_name . " WHERE unit LIKE ? ORDER BY ROId DESC";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $keywords = htmlspecialchars(strip_tags($keywords));
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
